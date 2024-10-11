# backend-template
Modelo contendo estrutura de diretórios, branches e arquivos do backend

## Instruções

As seguintes instruções são recomendadas para o uso deste template de projeto após iniciar novo repositório:

1. Executar comando para instalação de todas as dependências do projeto (produção e desenvolvimento):
   ```
   composer install
   ```
2. Copiar arquivo `.env.example` para `.env` para uso de configurações predefinidas para aplicação e lembrar de preencher outras informações necessárias:
   ```
   cp .env.example .env
   ```

## Observações

### API de Acesso
Este template possui uma API de Acesso opcional para ser utilizada em caso de a aplicação que será gerada for precisar de autenticação "isolada" (para mais informações, conversar com [Rocha](https://github.com/danielgr-sh3) ou [Bárbara](https://github.com/barbara-b-boechat-sh3)). Para configuração da API de acesso, segue informações:

1. [CreateAccessApi](app/Console/Commands/CreateAccessApi.php): comando para disponbilizar e configurar arquivos necessários para API de acesso
    ```
    php artisan backend-template:criar-api-acesso
    ```
2. [ClearStubAccessApi](app/Console/Commands/ClearStubAccessApi.php): comando para apagar arquivos necessários para disponibilizar API de acesso
    ```
    php artisan backend-template:limpar-arquivos-api-acesso
    ```

### rebing/graphql-laravel
Em caso do repositório criado for aproveitar códigos implementados utilizando a biblioteca rebing/grpahql-laravel, faz-se necessário os passos descritos no documento: [Passo a passo rebing/graphql-laravel → lighthouse](https://www.notion.so/Passo-a-passo-rebing-graphql-laravel-lighthouse-10e28ec02ee9805188cfee2d2329a5d2?pvs=4)
