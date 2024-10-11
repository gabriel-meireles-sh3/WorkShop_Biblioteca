<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;

use function Laravel\Prompts\confirm;

class ClearStubAccessApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'backend-template:limpar-arquivos-api-acesso';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Excluir arquivos temporários necessários para API de acesso';

    /**
     * The filesystem instance.
     *
     * @var Illuminate\Filesystem\Filesystem
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
        $choice = confirm('Confirmar exclusão dos arquivos?', false, 'Sim', 'Não', false);
        if ($choice) {
            $this->files->deleteDirectory(storage_path('/app/access-api'));
            $this->info('Arquivos excluídos');
        }
    }
}
