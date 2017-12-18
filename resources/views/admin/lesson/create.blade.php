@extends('admin.layout.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">课程管理</h3>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs" role="tablist">
                <li><a href="/admin/lesson">课程列表</a></li>
                <li class="active"><a href="/admin/lesson/create">课程添加</a></li>
            </ul>
            <br>
            <form onsubmit="post(event)" method="post" class="form-horizontal" role="form">
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">课程添加</h3>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label for="inputID" class="col-sm-2 control-label">课程标题:</label>
                            <div class="col-sm-10">
                                <input type="text" name="title" id="inputID" class="form-control" value="" title=""
                                >
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputID" class="col-sm-2 control-label">课程标签:</label>
                            <div class="col-sm-10">
                                @foreach($tagData as $tag)
                                    <input type="checkbox" name="tag[]" value="{{$tag['id']}}">{{$tag['name']}}
                                @endforeach
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputID" class="col-sm-2 control-label">课程介绍:</label>
                            <div class="col-sm-10">
                                <input type="text" name="introduce" id="inputID" class="form-control" value="" title="">
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="inputID" class="col-sm-2 control-label">课程预览图:</label>
                            <div class="col-sm-10">
                                <div class="input-group">
                                    <input class="form-control" name="preview" readonly="" value="">
                                    <div class="input-group-btn">
                                        <button onclick="upImage(this)" class="btn btn-default" type="button">选择图片
                                        </button>
                                    </div>
                                </div>
                                <div class="input-group" style="margin-top:5px;">
                                    <img src="/node_modules/hdjs/dist/static/image/nopic.jpg"
                                         class="img-responsive img-thumbnail" width="150">
                                    <em class="close" style="position:absolute; top: 0px; right: -14px;" title="删除这张图片"
                                        onclick="removeImg(this)">×</em>
                                </div>
                            </div>
                            <script>
                                let webUrl = '{{asset('/')}}';
                                require(['hdjs']);

                                //上传图片
                                function upImage() {
                                    require(['hdjs'], function (hdjs) {
                                        options = {
                                            multiple: false,//是否允许多图上传
                                            //data是向后台服务器提交的POST数据
                                            data: {name: '后盾人', year: 2099},
                                            //压缩图片尺寸
                                            compress: {
                                                width: 1600,
                                                height: 1600,
                                            }
                                        };
                                        hdjs.image(function (images) {
                                            //上传成功的图片，数组类型
                                            $("[name='preview']").val(images[0]);
                                            $(".img-thumbnail").attr('src', webUrl + images[0]);
                                        }, options)
                                    });
                                }

                                //移除图片
                                function removeImg(obj) {
                                    $(obj).prev('img').attr('src', '/node_modules/hdjs/dist/static/image/nopic.jpg');
                                    $(obj).parent().prev().find('input').val('');
                                }
                            </script>
                        </div>

                        <div class="form-group">
                            <label for="inputID" class="col-sm-2 control-label">推荐与热门:</label>
                            <div class="col-sm-10">
                                <input type="checkbox" name="iscommend" value="1">推荐
                                <input type="checkbox" name="ishot" value="1">热门
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inputID" class="col-sm-2 control-label">点击次数:</label>
                        <div class="col-sm-10">
                            <input type="number" name="click" id="inputID" class="form-control" value="" title="">
                        </div>
                    </div>
                </div>

                <div class="panel panel-default" id="app">
                    <div class="panel-heading">
                        <h3 class="panel-title">视频添加</h3>
                    </div>
                    <div class="panel panel-default" v-for="(v,k) in videos">
                        <div class="panel-body">
                            <div class="form-group">
                                <div class="col-sm-12">
                                    <input type="text" v-model="v.title" id="inputID" class="form-control"
                                           placeholder="视频标题">
                                </div>
                            </div>
                            <div class="input-group">
                                <input class="form-control" v-model="v.path" readonly="readonly">
                                <span class="input-group-btn">
                                    <button class="btn btn-default oss" type="button" :id="v.id">上传文件</button>
                                </span>
                            </div>
                            <span :id="'process'+v.id" style="display: none;color: red;">0%</span>
                            <div class="panel-footer">
                                <button type="button" class="btn btn-xs btn-danger" @click="del(k)">删除</button>
                            </div>
                        </div>
                    </div>
                    <textarea name="videos" hidden>@{{ videos }}</textarea>
                    <div class="container">
                        <button type="button" @click="add" class="btn btn-sm btn-success">添加一个视频</button>
                        <br>
                        <br>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-sm-11 col-sm-offset-1">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </form>
        </div>
        <script>
            require(['vue'], function (Vue) {
                new Vue({
                    el: '#app',
                    data: {
                        videos: []
                    },
                    methods: {
                        add() {
                            let field = {title:'',path:'',id:'hd'+Date.parse(new Date())};
                            this.videos.push(field);
                            setTimeout(function () {
                                uploadVideo(field);
                            },200);
                        },
                        del(k) {
                            this.videos.splice(k, 1)
                        }
                    },
                    mounted(){
                        this.add();
                    }
                })
            });

            function uploadVideo(field){
                require(['hdjs'], function (hdjs) {
                    let id = '#'+field.id;
                    let uploader = hdjs.oss.upload({
                        //获取签名
                        serverUrl: '/sign?',
                        //上传目录
                        dir: 'houdunwang/',
                        //按钮元素
                        pick: id,
                        accept: {
                            title: 'Images',
                            extensions: 'mp4',
                            mimeTypes: 'video/mp4'
                        }
                    });
                    //上传开始
                    uploader.on('startUpload', function () {
                        console.log('开始上传');
                        $('#process'+field.id).show();
                    });
                    //上传成功
                    uploader.on('uploadSuccess', function (file, response) {
                        console.log('上传完成,文件名:' + hdjs.oss.oss.host + '/' + hdjs.oss.oss.object_name);
                        field.path=hdjs.oss.oss.host + '/' + hdjs.oss.oss.object_name;
                    });
                    //上传中
                    uploader.on('uploadProgress', function (file, percentage) {
                        console.log('上传中,进度:' + parseInt(percentage * 100));
                        $('#process'+field.id).html(parseInt(percentage * 100)+'%');
                    });
                    //上传结束
                    uploader.on('uploadComplete', function () {
                        console.log('上传结束');
                        $('#process'+field.id).hide();
                    })
                });
            }

            function post(event) {
                event.preventDefault();
                require(['hdjs'], function (hdjs) {
                    hdjs.submit({
                        url:'/admin/lesson',
                        callback: function (response) {
                            if (response.valid == 1) {
                                hdjs.message(response.message, response.url);
                            } else {
                                hdjs.message(response.message, '', 'info');
                            }
                        }
                    });
                })
            }
        </script>
    </div>
    <!-- TAB NAVIGATION -->



@endsection