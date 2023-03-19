<?php

namespace Kuber\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Process as ProcessFacades;
use Symfony\Component\Process\Exception\ProcessFailedException;

class KuberCreateRepositoryCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:repository {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create Repository';

    /**
     * Nome do model
     *
     * @var String
     */
    private String $model;

    /**
     * Caminho dos arquivos stubs
     *
     * @var String
     */
    private String $stubPath;

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->model = ucfirst($this->argument('name'));

        $this->info('Creating Kuber repository ' . $this->model . '...');

        $this->createStubs();

        $this->info('Kuber repository created successfully.');
    }

    /**
     * Recuperar caminho e sobrescrever caso exista
     *
     * @param String $dir
     * @return string
     */
    private function getPathForce(String $dir): string
    {
        $path = app_path($dir);

        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
        File::makeDirectory($path, 0755, true);

        return $path;
    }

    /**
     * Recuperar caminho e sobrescrever arquivo caso exista
     *
     * @param String $dir
     * @param String $fileName
     * @return string
     */
    private function getFileForce(String $dir, String $fileName): string
    {
        $path = app_path($dir);
        $file = $path . $fileName;

        if (File::exists($path) == false) {
            File::makeDirectory($path);
        }

        if (File::exists($file)) {
            File::delete($file);
        }

        return $file;
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

        $path = $this->getPathForce('Repositories/' . $this->model);

        foreach ($files as $file) {
            $stub = file_get_contents($this->stubPath . '/' . $file . '.php.stub');
            $content = str_replace('{{name}}', $this->model, $stub);

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

        $nameFile = str_replace("Model", $this->model, $file);
        $nameFile .= ".php";

        $pathFile = $this->getFileForce('Providers/Repositories/', $nameFile);

        file_put_contents($pathFile, $content);

        $this->addProviderConfigApp();
    }

    private function addProviderConfigApp():void
    {
        $appConfigPath = config_path('app.php');

        $appConfigContent = file_get_contents($appConfigPath);

        $providerClass = 'App\Providers\Repositories\\' . $this->model . 'RepositoryProvider::class';

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
