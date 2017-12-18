<?php

namespace App\Http\Controllers\Api;

use App\Model\Lesson;
use App\Model\Tag;
use App\Model\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ContentController extends CommonControlller
{
    public function tags(){
        return $this->response(Tag::all());
    }

    public function lessons($tid=null){
        if($tid){
            $data = DB::table('lessons')
                ->join('lesson_tags','id','=','lesson_id')
                ->where('tag_id',$tid)
                ->get();
            return $this->response($data);
        }else{
            return $this->response(Lesson::get());
        }
    }
    public function videos($lid){
        return $this->response(Video::where('lesson_id',$lid)->get());
    }

    public function HotLessons($rows){
        return $this->response(Lesson::where('ishot',1)->limit($rows)->get());
    }

    public function CommendLessons($rows){
        return $this->response(Lesson::where('iscommend',1)->limit($rows)->get());
    }

    public function preLesson($lid){
        return $this->response(Lesson::find($lid));
    }
}
