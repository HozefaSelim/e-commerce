<?php 

namespace App\Traits;


trait ReturnTrait{

    public function returnError( $msg="some error" , $code=404){

        return response()->json([
            "status" => false,
            "message" => $msg,
          ], $code);
    }
    public function returnSuccess($msg , $code=200){
        return response()->json([
            "status" => true,
            "message" => $msg,
          ], $code);
    }
    public function returnData($key,$value,$msg="",$code=200){
       return response()->json([
            "status" => true,
            "message" => $msg,
            $key => $value
          ],$code);

    }
}