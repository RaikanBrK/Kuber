<?php

namespace Kuber\Console;

use Kuber\Traits\Console\Model;
use Illuminate\Console\Command;

class KuberCreateRepositoryCommand extends Command
{
    use Model;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name} {model?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Repository';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->runName();

        $this->info('Creating Kuber repository ' . $this->model . '...');

        $this->createStubs();

        $this->info('Kuber repository created successfully.');
    }

    /**
     * Criando stubs
     *
     * @return void
     */
    private function createStubs(): void
    {
        $this->stubPath = __DIR__ . '/stubs/repository';

        $this->createRepositories();
        $this->createProvider();
    }

    /**
     * Criando arquivos dos repositórios com base no arquivos stub
     *
     * @return void
     */
    private function createRepositories(): void
    {
        $files = [
            "repository" => "Repository",
            "eloquent" => "EloquentRepository",
        ];

        $path = $this->getPath('Repositories', true);

        foreach ($files as $file) {
            $stub = file_get_contents($this->stubPath . '/' . $file . '.php.stub');

            $content = str_replace('{{name}}', $this->model, $stub);

            $model = empty($this->argument('model')) ? $this->model : ucfirst($this->argument('model'));
            $content = str_replace('{{model}}', $model, $content);

            $namespace = str_replace("/", "\\", $this->getSubFolder() . $this->model);
            $content = str_replace('{{namespace}}', $namespace, $content);
            
            $nameFile = str_replace("Repository", "{$this->model}Repository", $file);
            $nameFile .= ".php";

            file_put_contents($path . '/' . $nameFile, $content);
        }
    }

    /**
     * Criando provider do repositório
     *
     * @return void
     */
    private function createProvider(): void
    {
        $file = "ModelRepositoryProvider";

        $stub = file_get_contents($this->stubPath . '/' . $file . '.php.stub');
        $content = str_replace('{{name}}', $this->model, $stub);

        $namespace = str_replace("/", "\\", substr($this->getSubFolder(), 0, -1));
        $namespace = empty($namespace) ? '' : "\\" . $namespace;
        $content = str_replace('{{namespace}}', $namespace, $content);
        
        $namespaceRepository = str_replace("/", "\\", $this->getSubFolder()) . $this->model;
        $content = str_replace('{{namespaceRepository}}', $namespaceRepository, $content);

        $nameFile = str_replace("Model", $this->model, $file);
        $nameFile .= ".php";

        $path = $this->getPath('Providers/Repositories', false, $nameFile, false);
        $pathFile = $path . '/' . $nameFile;

        file_put_contents($pathFile, $content);

        $this->addProviderConfigApp($namespace);
    }

    private function addProviderConfigApp($namespace):void
    {
        $appConfigPath = config_path('app.php');

        $appConfigContent = file_get_contents($appConfigPath);

        $providerClass = 'App\Providers\Repositories' . $namespace . "\\" . $this->model . 'RepositoryProvider::class';
        $string = '/* Repositories Service Providers... */';

        $classExist = strpos($appConfigContent, $providerClass);

        if ($classExist == false) {
            $appConfigContent = str_replace(
                $string,
                "{$string} \n        " . $providerClass . ",",
                $appConfigContent
            );
    
            file_put_contents($appConfigPath, $appConfigContent);
        } else {
            $this->info('Classe já foi importada anteriormente');
        }        
    }
}
