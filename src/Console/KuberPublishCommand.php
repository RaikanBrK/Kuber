<?php

namespace Kuber\Console;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Process;

class KuberPublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kuber:publish {--force : Force the command to run.}  {--forceOptional : Force assets optional the command to run.}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Publicando arquivos do kuber';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $force = $this->option('force');
        $forceOptional = $this->option('forceOptional');

        $this->call('vendor:publish', [
            '--tag' => 'kuber-assets',
            '--force' => $force,
        ]);

        $this->call('vendor:publish', [
            '--tag' => 'kuber-assets-optional',
            '--force' => $forceOptional,
        ]);
        if ($forceOptional) {
            $this->info('Execute o comando npm install');
        }

        $this->info('Arquivos publicadas com sucesso');
    }
}
