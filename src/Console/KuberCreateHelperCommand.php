<?php

namespace Kuber\Console;

use Kuber\Traits\Console\Model;
use Illuminate\Console\Command;

class KuberCreateHelperCommand extends Command
{
    use Model;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'make:helper {name} {trait?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create helper';

    private String|null $trait = null;

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->runName();

        $this->info('Creating Kuber helper ' . $this->model . '...');

        $this->createStubs();

        $this->info('Kuber helper created successfully.');
    }

    /**
     * Criando stubs
     *
     * @return void
     */
    private function createStubs(): void
    {
        $this->stubPath = __DIR__ . '/stubs/helper';

        $this->createTrait();
        $this->createHelper();
    }

    /**
     * Criando arquivos dos repositórios com base no arquivos stub
     *
     * @return void
     */
    private function createTrait(): void
    {
        $trait = $this->argument('trait');
        if ($trait != null) {
            $trait = $trait == 'true' ? $this->getSubFolder() . $this->model : $trait;
            $this->call('make:trait', [
                'name' => $trait,
            ]);

            $traitArray = explode("/", $trait);
            $traitArray = array_map('ucfirst', $traitArray);
            $trait = implode("\\", $traitArray);

            $this->trait = $trait;
        }
    }

    private function createHelper(): void
    {
        $file = 'Helper';

        $path = $this->getPath('Helper', false, false, false);

        $stub = file_get_contents($this->stubPath . '/' . $file . '.php.stub');
        $content = str_replace('{{name}}', $this->model, $stub);

        $namespace = str_replace("/", "\\", substr($this->getSubFolder(), 0, -1));
        $namespace = empty($namespace) ? '' : "\\" . $namespace;
        $content = str_replace('{{namespace}}', $namespace, $content);

        $traitNamespace = $this->trait == null ? '' :  "\nuse App\\Traits\\{$this->trait};\n";
        $content = str_replace('{{traitNamespace}}', $traitNamespace, $content);

        $traitArray = explode("\\", $this->trait);
        $trait = $traitArray[count($traitArray) - 1];
        $trait = $this->trait == null ? '' :  "use {$trait};\n    ";
        $content = str_replace('{{trait}}', $trait, $content);
        
        $nameFile = $this->model . "Helper.php";

        file_put_contents($path . '/' . $nameFile, $content);
    }
}
