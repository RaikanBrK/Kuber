<?php

namespace Kuber\Console;

use Illuminate\Console\Command;

class KuberDependencyInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kuber:install-dependency';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instalando dependências do kuber';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $this->call('adminlte:install');
        $this->call('sweetalert:publish');

        $this->info('Dependências instaladas com sucesso.');
    }
}
