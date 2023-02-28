<?php

namespace Kuber\Console;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Process as ProcessFacades;
use Symfony\Component\Process\Exception\ProcessFailedException;

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
        $process[] = new Process(['php', 'artisan', 'kuber:install-dependency']);

        $this->runProcessAndEchoMessage($process);

        ProcessFacades::run('php artisan vendor:publish --tag=kuber-assets --force');

        $this->info('Ferramentas do kuber instaladas com sucesso.');
    }
}
