<?php

namespace App\Modules;
use File;


class ModuleServiceProvider extends \Illuminate\Support\ServiceProvider{
  public function boot(){
    $modules = array_map('basename', \File::directories(__DIR__));
    foreach ($modules as $module) {
      if(file_exists(__DIR__.'/'.$module.'/routes.php')) {
          include __DIR__.'/'.$module.'/routes.php';
      }

      $view_path = __DIR__.'/'.$module.'/Views';
      if(is_dir($view_path)) {
         $this->loadViewsFrom($view_path, $module);
      }
    }

  }
  public function register() {}

}