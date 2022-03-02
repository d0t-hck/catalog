<?php

namespace App\Services;

interface FileServiceInterface {

    public function newFolder($path);

    public function rename($old, $new);

    public function delete($path);
}