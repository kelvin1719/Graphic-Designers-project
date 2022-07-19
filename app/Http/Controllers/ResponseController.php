<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;

class ResponseController extends Controller
{
    public function successResponse($msg , $data){
        return response()->json([
            'status'=> Response::HTTP_OK ,
            'msg'=>$msg,
            'data'=>$data,
        ]);
    }
    public function errorResponse($msg , $data){
        return \response()->json([
            'status'=>Response::HTTP_FORBIDDEN ,
            'msg' => $msg ,
            'data'=>$data
        ]);
    }
}
