<?php

namespace App\service;

use App\Services\FileServiceInterface;
use Illuminate\Support\Facades\File;
use Exception;

class FilesService implements FileServiceInterface {

    use File;
    private $base;

    function __construct() {
        $this->base = base_path('public' . DIRECTORY_SEPARATOR . 'images' . DIRECTORY_SEPARATOR);
    }

    public function newFolder($path)
    {
        File::makeDirectory($this->base.$path);
    }

    public function rename($old, $new) {
        if (!File::isDirectory($this->base.$old)) {
            return File::move($this->base.$old, $this->base.$new);
        }
        return File::moveDirectory($this->base.$old, $this->base.$new);
    }

    public function delete($path){
        try {
            File::cleanDirectory($this->base.$path);
            FIle::deleteDirectorie($this->base.$path);
        } catch (Exception $e) {
            return false;
        }
        return true;
    }

}