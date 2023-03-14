<?php

namespace Kuber\Console;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Process as ProcessFacades;
use Symfony\Component\Process\Exception\ProcessFailedException;

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
        ProcessFacades::run('php artisan vendor:publish --tag=kuber-assets --force');

        $this->info('Arquivos publicadas com sucesso');
    }
}
