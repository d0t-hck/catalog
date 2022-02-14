<?php

namespace App\Handlers;

class FileHandler {
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

      if (!FileHandler::deleteContent($path . DIRECTORY_SEPARATOR . $item)) {
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
      return rename($base.$old, $base.$new);
    }
    return false;
  }
  
}
