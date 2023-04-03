<?php

namespace Kuber\Traits\Console;

use Illuminate\Support\Facades\File;

trait Model {
    /**
     * Nome do model
     *
     * @var String
     */
    private String $model;

    private String|null $subFolder = null;

    /**
     * Caminho dos arquivos stubs
     *
     * @var String
     */
    private String $stubPath;

    private function getSubFolder()
    {
        return $this->subFolder == null ? '' : $this->subFolder . '/';
    }

    private function runName()
    {
        $name = $this->argument('name');
        $explodeName = explode("/", $name);

        $explodeName = array_map('ucfirst', $explodeName);

        $this->model = array_pop($explodeName);

        $this->subFolder = implode("/", $explodeName);
    }

    private function getPath(String $folder, $forceFolder, Bool $filenameRemoved = false, $addPathModel = true)
    {
        $dirInit = app_path($folder);
        $path = $dirInit . '/' . $this->getSubFolder();
        $path .= $addPathModel ? $this->model : '';

        if ($forceFolder && File::exists($path)) {
            File::deleteDirectory($path);
        }

        if (File::exists($path) == false) {
            File::makeDirectory($path, 0755, true);
        }

        if ($filenameRemoved != false) {
            File::delete($path . $filenameRemoved);
        }

        return $path;
    }
}