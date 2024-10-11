<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Facades\Artisan;

use function Laravel\Prompts\progress;

class CreateAccessApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backend-template:criar-api-acesso';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Configurar projeto com API de acesso usando JWT';

    /**
     * The Filesystem instance.
     *
     * @var \Illuminate\Filesystem\Filesystem
     */
    protected $files;

    public function __construct(Filesystem $files) {
        parent::__construct();

        $this->files = $files;
    }

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $progressBar = progress(
            label: 'Configurando projeto com API de acesso usando JWT',
            steps: 6
        );
        $progressBar->start();

        $progressBar->label('Copiando middleware JWT');
        $this->copyJwtMidlleware(
            storage_path('/app/access-api/Jwt.php'),
            app_path('/GraphQL/Middlewares')
        );
        $progressBar->advance();

        $progressBar->label('Atualizando classe App\Models\User.php');
        $this->files->copy(
            storage_path('/app/access-api/User.php'),
            app_path('/Models/User.php')
        );

        $progressBar->label('Configurando Lighthouse com middleware JWT');
        $this->configLighthouse(config_path('/lighthouse.php'));
        $progressBar->advance();

        $progressBar->label('Copiando arquivo auth.graphql');
        $this->files->copy(
            storage_path('/app/access-api/auth.graphql'),
            base_path('graphql/auth.graphql')
        );
        $progressBar->advance();

        $progressBar->label('Editando arquivo graphql/schema.graphql');
        $this->configSchema();
        $progressBar->advance();

        $progressBar->label('Copiando arquivos necessários para API de acesso');
        $this->files->copyDirectory(
            storage_path('/app/access-api/Auth'),
            app_path('/GraphQL/Auth')
        );
        $progressBar->advance();

        $progressBar->finish();
    }

    private function copyJwtMidlleware(string $from, string $to) : void
    {
        if (!$this->files->isDirectory($to)) {
            $this->files->makeDirectory($to);
        }
        $this->files->copy($from, $to.'/Jwt.php');

        Artisan::call('jwt:secret -q');
    }

    private function configLighthouse(string $path) : void
    {
        if (!$this->files->exists($path)) {
            Artisan::call('vendor:publish --tag=lighthouse-config');
        }
        $this->files->put(
            $path,
            str_replace(
                "// Nuwave\Lighthouse\Http\Middleware\LogGraphQLQueries::class,",
                "// Nuwave\Lighthouse\Http\Middleware\LogGraphQLQueries::class,
                
            App\GraphQL\Middlewares\Jwt::class,",
                $this->files->get($path)
            )
        );
    }

    private function configSchema() : void
    {
        $this->files->put(
            base_path('/graphql/schema.graphql'),
            str_replace(
                "\\\DateTime\")",
                "\\\DateTime\")

#import auth.graphql",
                $this->files->get(base_path('/graphql/schema.graphql'))
            )
        );
    }
}
