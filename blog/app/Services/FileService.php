<?php

namespace App\Services;

class FileService {
  public static function deleteContent($path) {
    if (!file_exists($path)) {
      return true;
    }

    if (!is_dir($path)) {
      return unlink($path);
    }

    foreach (scandir($path) as $item) {
      if ($item == '.' || $item == '..') {
        continue;
      }

      if (!FileService::deleteContent($path . DIRECTORY_SEPARATOR . $item)) {
        return false;
      }
    }
    return rmdir($path);
  }

  public static function createFolder($path) {
    if (!file_exists($path)) {
      return mkdir($path);
    }
  }

  public static function changeName($old, $new, $base) {
    if (file_exists($base.$old)) {
      if(!rename($base.$old, $base.$new)){
        if (copy($base.$old,$base.$new)){
           return FileService::deleteContent($base.$old);
        }
        return false;
      }
      return true;
    }
    return false;
  }

  public static function moveFiles($from, $to) {
    if (!file_exists($from)) {
      return true;
    }

    if (!is_dir($from)) {
      return rename($from, $to);
    }

    return rename($from, $to);
  }
  
}
