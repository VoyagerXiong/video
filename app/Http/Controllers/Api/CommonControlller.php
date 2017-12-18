<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

abstract class CommonControlller extends Controller
{
    protected function response($data,$code=200){
        return ['data'=>$data,'code'=>$code];
    }
}
