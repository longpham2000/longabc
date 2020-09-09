<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class connect extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
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
    public function apipostadd($url,$data){
            $token=session('token');
      $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json',"AuthorizationIcomSMSTest: ".$token));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
            $res = json_decode($result);
            if($res == null){
                die("api return data null");
            }  
            if($res->status == -1 || $res->status == 0){
                echo "<a href='".asset('/')."'về trang đăng nhập</a>";
                die($res->msg);
            }
            return $result;
         }
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
