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
    protected $signature = 'make:repository {name} {model?}';

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

    private String|null $subFolder = null;

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
        $this->runName();

        $this->info('Creating Kuber repository ' . $this->model . '...');

        $this->createStubs();

        $this->info('Kuber repository created successfully.');
    }

    private function getSubFolder()
    {
        return $this->subFolder == null ? '' : $this->subFolder . '/';
    }

    private function runName()
    {
        $name = ucfirst($this->argument('name'));
        $explodeName = explode("/", $name);

        $this->model = array_pop($explodeName);

        $this->subFolder = implode("/", $explodeName);
    }

    private function getPath(String $folder, $forceFolder, Bool $filenameRemoved = false, $addPathModel = true)
    {
        $dirInit = app_path($folder);
        $path = $dirInit . '/' . $this->getSubFolder();
        $path .= $addPathModel ? $this->model : '';

        if ($forceFolder && File::exists($path)) {
            File::deleteDirectory($path);
        }

        if (File::exists($path) == false) {
            File::makeDirectory($path, 0755, true);
        }

        if ($filenameRemoved != false) {
            File::delete($path . $filenameRemoved);
        }

        return $path;
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
