<?php

namespace Kuber\Console;

use Illuminate\Console\Command;
use Symfony\Component\Process\Process;
use Illuminate\Support\Facades\Process as ProcessFacades;
use Symfony\Component\Process\Exception\ProcessFailedException;

class KuberAddSweetAlertCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'kuber:sweet-alert';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Adicionando middleware do sweet alert no kernel';

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $kernelPath = app_path('Http/Kernel.php');

        $kernelContent = file_get_contents($kernelPath);

        $newMiddleware = "\RealRashid\SweetAlert\ToSweetAlert::class";

        if (strpos($kernelContent, $newMiddleware) == false && preg_match('/(\'web\'\s*=>\s*\[\s*)(.*?)\]/s', $kernelContent, $matches)) {
            $newWebGroup = str_replace(']', "    $newMiddleware,\n        ]", $matches[0]);

            $kernelContent = str_replace($matches[0], $newWebGroup, $kernelContent);

            file_put_contents($kernelPath, $kernelContent);
        }

        $this->info('Middleware do sweet-alert adicionado com sucesso!');
    }
}
