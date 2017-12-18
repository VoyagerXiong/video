@extends('admin.layout.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">标签管理</h3>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs" role="tablist">
                <li class="active"><a href="/admin/tag">标签列表</a></li>
                <li><a href="/admin/tag/create">标签添加</a></li>
            </ul>
            <table class="table table-hover">
                <thead>
                <tr>
                    <th width="100">ID</th>
                    <th>标题名称</th>
                    <th width="120">操作</th>
                </tr>
                </thead>
                <tbody>
                @foreach($tags as $v)
                <tr>
                    <td>{{$v['id']}}</td>
                    <td>{{$v['name']}}</td>
                    <td>
                        <div class="btn-group">
                            <a href="/admin/tag/{{$v['id']}}/edit" class="btn btn-xs btn-primary">编辑</a>
                            <a onclick="del({{$v['id']}})" class="btn btn-xs btn-danger">删除</a>
                        </div>
                    </td>
                </tr>
                </tbody>
                @endforeach
            </table>
        </div>
        <script>
            function del(id){
                if(confirm('确定要删除吗')){
                    $.ajax({
                        url:'/admin/tag/' + id,
                        method:'DELETE',
                        success:function(response){
                            location.reload();
                        }
                    })
                }
            }
        </script>
    </div>
    <!-- TAB NAVIGATION -->



@endsection