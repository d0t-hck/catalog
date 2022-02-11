<?php

namespace App\Handlers;

use \DirectoryIterator;
use \Exception;

class FileHandler {
  public static function deleteContent($path) {
    try{
      $iterator = new DirectoryIterator($path);
      foreach ( $iterator as $fileinfo ) {
        if($fileinfo->isDot())continue;
        if($fileinfo->isDir()){
          if(FileHandler::deleteContent($fileinfo->getPathname()))
            rmdir($fileinfo->getPathname());
        }
        if($fileinfo->isFile()){
          unlink($fileinfo->getPathname());
        }
      }
    } catch ( Exception $e ){
       // write log
       return false;
    }
    return true;
  }
}
