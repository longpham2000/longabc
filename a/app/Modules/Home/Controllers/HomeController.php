<?php
namespace App\Modules\Home\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  App\Providers\connect;

class HomeController extends Controller
{   
	 public function  apiget($url){
          if($json = @file_get_contents("http://14.160.70.230:11080/IcomESignature/swagger-ui.html#", true)){
            $token=session('token');;
            $opts = array('http' =>
                        array(
                            'method'  => 'GET',
                            'header'  => array("AuthorizationIcomSMSTest: ".$token), 
                           
                        )
                    );
                    $context  = stream_context_create($opts);
                    $result =  file_get_contents($url, true, $context);
        $res = json_decode($result);
        if($res == null){
            die("api return data null");
        }  
        if($res->status == -1 || $res->status == 0){ 
            echo "<a href='".asset('/')."'về trang đăng nhập</a>";
            die($res->msg);
        }
        return  $result;
        }
        else{
            return "";
                }
    } 
     public function danhsach(){
        
        $repson=json_decode( $this->apiget('http://14.160.70.230:11080/IcomESignature/api/department/list?page_index=1&page_size=10'));
        $repson=$repson->data;
        dd($repson);
        return view('Department::list',compact('repson'));
    }

    public function add_name(Request $request){
	    $api=new connect();
	    $postdata = (
	        array(
	            'ma' => $request->ma,
	            'ten' => $request->ten,
	            "matkhau"=>$request->matkhau
	        )
	    );
	    $repson=json_decode( $api->apipost('link api dự án', $postdata));
	    dd($repson);
	    return view('Home::index');
    }


}
