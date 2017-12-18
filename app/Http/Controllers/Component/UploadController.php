<?php

namespace App\Http\Controllers\Component;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class UploadController extends Controller
{
    public function uploader(Request $request)
    {
        $upload = $request->file;
//        p(get_class_methods($upload));
        if ($upload->isValid()) {
            $path = $upload->store(date('ymd'));
            return ['valid'=>1,'message'=>'attachment/'.$path];
        }
        return ['valid'=>0,'message'=>'上传失败'];
    }
}
