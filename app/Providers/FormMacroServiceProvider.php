<?php
namespace App\Providers;

use Form;
use Illuminate\Support\ServiceProvider;

class FormMacroServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        Form::macro('datalist', function ($name, $id, $class, $data) {
          $result = array();
          $result[] = '<input id='.$name.' name='.$name.' list='.$id.' class='.$class.'>';
          $result[] = '<datalist id='.$id.'>';
          if($data == '')
          {

          }else {
            foreach ($data as $key => $value) {
              $result[] = '<option id='.$key.' value='.$value.'>';
            }
          }
          $result[] = '</datalist>';
          return join("\n", $result);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
