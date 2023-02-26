<?php

namespace Kuber\Console;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;

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
        $process1 = new Process(['php', 'artisan', 'adminlte:install']);
        $process1->run();

        $process2 = new Process(['php', 'artisan', 'ui bootstrap --auth']);
        $process2->run();

        $this->info('Dependências instaladas com sucesso.');
    }
}
