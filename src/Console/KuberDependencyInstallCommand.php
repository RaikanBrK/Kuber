<?php

namespace Kuber\Console;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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

    private function runProcessAndEchoMessage(array $processList)
    {
        try {
            foreach($processList as $process) {
                $process->run();
                echo $process->getOutput();
            }
        } catch (ProcessFailedException $exception) {
            echo $exception->getMessage();
        }
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $process = array();
        $process[] = new Process(['php', 'artisan', 'adminlte:install']);
        $process[] = new Process(['npm', 'install', 'bootstrap@4.6']);
        $process[] = new Process(['npm', 'install', '@popperjs/core']);
        $process[] = new Process(['npm', 'install', 'sass']);
        $process[] = new Process(['npm', 'install', 'jquery']);
        $process[] = new Process(['npm', 'install', '@fortawesome/fontawesome-free']);
        $process[] = new Process(['php', 'artisan', 'sweetalert:publish']);
        $process[] = new Process(['php', 'artisan', 'kuber:sweet-alert']);

        $this->runProcessAndEchoMessage($process);

        $this->info('Dependências instaladas com sucesso.');
    }
}
