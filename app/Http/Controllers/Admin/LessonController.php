<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\LessonPost;
use App\Model\Lesson;
use App\Model\LessonTag;
use App\Model\Tag;
use App\Model\Video;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Lesson::get();
        foreach ($data as $k => $v) {
            $tags = DB::table('lesson_tags')
                ->join('tags','tag_id','=','id')
                ->where('lesson_id',$v['id'])
                ->get();
            $tagStr = '';
            foreach($tags as $t){
                $tagStr .=$t->name.',';
            }
            $tagStr = rtrim($tagStr,',');
            $data[$k]['_tag'] = $tagStr;
            $data[$k]['_videonum'] = Video::where('lesson_id',$v['id'])->count();
        }
        return view('admin.lesson.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tagData = Tag::all();
        return view('admin.lesson.create', compact('tagData'));
    }


    public function store(Request $request,LessonPost $lessonPost)
    {
//        存入数据库
//        1.课程表
        $lessonmodel = new Lesson();
        $lessonmodel->title = $request->input('title');
        $lessonmodel->introduce = $request->input('introduce');
        $lessonmodel->preview = $request->input('preview');
        $lessonmodel->iscommend = $request->input('iscommend') ?: 0;
        $lessonmodel->ishot = $request->input('ishot') ?: 0;
        $lessonmodel->click = $request->input('click');
        $lessonmodel->save();
        $lessonid = $lessonmodel->id;

//        2.课程表与标签表中间表
        foreach ($request->tag as $t) {
            $lessontag = new LessonTag();
            $lessontag->lesson_id = $lessonid;
            $lessontag->tag_id = $t;
            $lessontag->save();
        }

//        3.视频表
        $videos = json_decode($request->videos, true);
        foreach ($videos as $v) {
            $lessontag = new Video();
            $lessontag->lesson_id = $lessonid;
            $lessontag->title = $v['title'];
            $lessontag->path = $v['path'];
            $lessontag->save();
        }

        return ['valid' => 1, 'message' => '保存成功', 'url' => '/admin/lesson'];
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tagData = Tag::all();
        $lessondata = Lesson::find($id);
        $lessontags = LessonTag::where('lesson_id',$id)->get();
        $tagid = [];
//        p($lessontags);exit;
        foreach($lessontags as $v){
            $tagid[]=$v['tag_id'];
        }
        $videodata = Video::where('lesson_id',$id)->get();
//        采用模型关联调用数据
//        $videos = $lessondata->videos()->get();
//        p($videos);
        $videodata = json_encode($videodata,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT|JSON_UNESCAPED_SLASHES);
        return view('admin.lesson.edit',compact('tagData','lessondata','tagid','videodata'));
    }

    public function update(Request $request, $id,LessonPost $lessonPost)
    {
//        1.修改课程表
        $lessonmodel = Lesson::find($id);
        $lessonmodel->title = $request->input('title');
        $lessonmodel->introduce = $request->input('introduce');
        $lessonmodel->preview = $request->input('preview');
        $lessonmodel->iscommend = $request->input('iscommend') ?: 0;
        $lessonmodel->ishot = $request->input('ishot') ?: 0;
        $lessonmodel->click = $request->input('click');
        $lessonmodel->save();

//        2.修改中间表
        LessonTag::where('lesson_id',$id)->delete();
        foreach ($request->tag as $t) {
            $lessontag = new LessonTag();
            $lessontag->lesson_id = $id;
            $lessontag->tag_id = $t;
            $lessontag->save();
        }

//        3.修改视频表
        Video::where('lesson_id',$id)->delete();
        $videos = json_decode($request->videos, true);
        foreach ($videos as $v) {
            $lessontag = new Video();
            $lessontag->lesson_id = $id;
            $lessontag->title = $v['title'];
            $lessontag->path = $v['path'];
            $lessontag->save();
        }
        return redirect('/admin/lesson');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
//        p($id);exit;
        Video::where('lesson_id',$id)->delete();
        LessonTag::where('lesson_id',$id)->delete();
        Lesson::destroy($id);
    }
}
