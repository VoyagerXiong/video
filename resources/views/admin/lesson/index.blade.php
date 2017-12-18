@extends('admin.layout.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">课程管理</h3>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="/admin/lesson">课程列表</a></li>
                <li><a href="/admin/lesson/create">课程添加</a></li>
            </ul>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="30">ID</th>
                    <th>课程名称</th>
                    <th width="100">课程预览图</th>
                    <th>课程标签</th>
                    <th>视频数量</th>
                    <th>添加时间</th>
                    <th width="120">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($data as $v)
                    <tr>
                        <td>{{$v['id']}}</td>
                        <td>{{$v['title']}}</td>
                        <td><img src="{{asset('/').$v['preview']}}" alt="" width="100"></td>
                        <td>{{$v['_tag']}}</td>
                        <td>{{$v['_videonum']}}</td>
                        <td>{{$v['created_at']}}</td>
                        <td>
                            <div class="btn-group">
                                <a href="/admin/lesson/{{$v['id']}}/edit" class="btn btn-xs btn-primary">编辑</a>
                                <a onclick="del({{$v['id']}})" class="btn btn-xs btn-danger">删除</a>
                            </div>
                        </td>
                    </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        <script>
            function del(id) {
                if (confirm('确定要删除吗')) {
                    $.ajax({
                        url: '/admin/lesson/' + id,
                        method: 'DELETE',
                        success: function (response) {
                            location.reload();
                        }
                    })
                }
            }
        </script>
    </div>
    <!-- TAB NAVIGATION -->



@endsection