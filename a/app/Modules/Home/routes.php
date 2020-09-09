<?php
$namespace = 'App\Modules\Home\Controllers';
Route::group(
    ['module'=>'Home', 'namespace' => $namespace],
    function() {
        Route::get('category', "HomeController@danhsach");
    }
);