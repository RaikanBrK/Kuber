<?php

namespace Kuber\Console;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Process as ProcessFacades;

class KuberInstallCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kuber:install';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Instalando ferramentas do kuber';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $process1 = new Process(['php', 'artisan', 'kuber:install-dependency']);
        $process1->run();

        $process2 = new Process(['npm', 'install', ' bootstrap sass --dev']);
        $process2->run();

        ProcessFacades::run('php artisan vendor:publish --tag=kuber-auth-config --tag=kuber-auth-migrations --tag=kuber-auth-models --force');

        $this->info('Ferramentas do kuber instaladas com sucesso.');
    }
}
