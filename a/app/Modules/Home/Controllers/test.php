<?php
namespace App\Modules\Home\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class test extends Controller{
    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct(){
        # parent::__construct();
    }
    public function index(Request $request){
        
        return view('Home::index');
    }
}