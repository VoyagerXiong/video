@extends('admin.layout.master')

@section('content')
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">标签管理</h3>
        </div>
        <div class="panel-body">
            <ul class="nav nav-tabs" role="tablist">
                <li><a href="/admin/tag">标签列表</a></li>
                <li class="active"><a href="/admin/tag/create">标签添加</a></li>
            </ul>
            <br>
            <form action="/admin/tag/{{$data['id']}}" method="post" class="form-horizontal" role="form" >
                {{method_field('PUT')}}
                @if (count($errors) > 0)
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <div class="form-group">
                    <label for="inputID" class="col-sm-2 control-label">标题名称:</label>
                    <div class="col-sm-10">
                        <input type="text" name="name" id="inputID" class="form-control" value="{{$data['name']}}" title="">
                    </div>
                </div>

                <div class="form-group">
                    <div class="col-sm-10 col-sm-offset-2">
                        {{csrf_field()}}
                        <button type="submit" class="btn btn-primary">保存</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- TAB NAVIGATION -->



@endsection