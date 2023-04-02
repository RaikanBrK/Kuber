<?php

namespace Kuber\Console;

use Illuminate\Console\Command;

class KuberPublishCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kuber:publish';

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
        $this->call('vendor:publish', [
            '--tag' => 'kuber-assets',
            '--force' => true,
        ]);

        $this->info('Arquivos publicadas com sucesso');
    }
}
