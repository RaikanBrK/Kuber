<?php

namespace Kuber\Console;

use Illuminate\Console\Command;

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
        $this->call('kuber:install-dependency');
        $this->call('kuber:publish', [
            '--force' => true,
            '--forceOptional' => true,
        ]);

        $this->info('Ferramentas do kuber instaladas com sucesso.');
    }
}
