<?php

namespace Kuber\Console;

use Kuber\Traits\Console\Model;
use Illuminate\Console\Command;

class KuberCreateTraitCommand extends Command
{
    use Model;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:trait {name}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create trait';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->runName();

        $this->info('Creating Kuber trait ' . $this->model . '...');

        $this->createStubs();

        $this->info('Kuber trait created successfully.');
    }

    /**
     * Criando stubs
     *
     * @return void
     */
    private function createStubs(): void
    {
        $this->stubPath = __DIR__ . '/stubs/traits';

        $this->createTrait();
    }

    /**
     * Criando arquivos dos repositórios com base no arquivos stub
     *
     * @return void
     */
    private function createTrait(): void
    {
        $file = 'Trait';

        $path = $this->getPath('Traits', false, false, false);

        $stub = file_get_contents($this->stubPath . '/' . $file . '.php.stub');
        $content = str_replace('{{name}}', $this->model, $stub);

        $namespace = str_replace("/", "\\", substr($this->getSubFolder(), 0, -1));
        $namespace = empty($namespace) ? '' : "\\" . $namespace;
        $content = str_replace('{{namespace}}', $namespace, $content);
        
        $nameFile = str_replace("Trait", "{$this->model}", $file);
        $nameFile .= ".php";

        file_put_contents($path . '/' . $nameFile, $content);
    }
}
