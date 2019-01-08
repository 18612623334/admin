<!DOCTYPE html>
<html>

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">


    <title>H+ 后台主题UI框架 - 数据表格</title>

    <link rel="shortcut icon" href="favicon.ico">
    <link href="/style/css/bootstrap.min.css?v=3.3.7" rel="stylesheet">
    <link href="/style/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">

    <!-- Data Tables -->
    <link href="/style/css/plugins/dataTables/dataTables.bootstrap.css" rel="stylesheet">

    <link href="/style/css/animate.min.css" rel="stylesheet">
    <link href="/style/css/style.css?v=4.0.0" rel="stylesheet"><base target="_blank">

</head>

<body class="gray-bg">
<div class="wrapper wrapper-content animated fadeInRight">
    <div class="row">
        <div class="col-sm-12">
            <div class="ibox float-e-margins">
                <div class="ibox-content">
                    <div class="row">
                        <form target="_self" action="{{ URL::route('admin.admin-group') }}" method="get">
                            <div class="col-sm-3">
                                <div class="input-group">
                                    <input type="text" name="group_name" value="{{Request::get('group_name','')}}" placeholder="请输入用户组名称" class="input-sm form-control">
                                    <span class="input-group-btn">
                                        <button type="submit" class="btn btn-sm btn-primary"> 搜索</button>
                                </span>
                                </div>
                            </div>
                        </form>
                        <div class="col-sm-3" style="float: right;">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a target="_self" href="{{ URL::route('admin.add-group',['group_id'=>0]) }}">
                                        <button type="button" class="btn btn-sm btn-primary add">
                                            添加用户组
                                        </button>
                                    </a>
                                </span>
                            </div>
                        </div>
                    </div>

                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th>id</th>
                            <th>用户组昵称</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $v)
                            <tr class="gradeX">
                                <td>{{$v['gid']}}</td>
                                <td>{{$v['group_name']}}</td>
                                <td>{{$v['created_at']}}</td>
                                <td class="center">
                                    <a target="_self" href="{{ URL::route('admin.add-group',['group_id'=>$v['gid']]) }}">编辑</a> |
                                    <a target="_self" href="{{URL::route('admin.authorization',['group_id'=>$v['gid']])}}">授权管理</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('style/js/jquery.min.js')}}"></script>
<script src="{{asset('style/js/bootstrap.min.js')}}"></script>
<script src="{{asset('style/js/plugins/jeditable/jquery.jeditable.js')}}"></script>
<script src="{{asset('style/js/content.min.js')}}"></script>
<script type="text/javascript" src="{{asset('style/layer/layer.js')}}"></script>
<script src="{{asset('style/js/plugins/footable/footable.all.min.js')}}"></script>

<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>

<script>

    $(function () {

        $(".status_admin").click(function () {
            var tdEle = $(this);
            var url = tdEle.data("href");
            var title = tdEle.data('title');
            layer.confirm(title, {
                btn: ['确定','取消']
            }, function(){
                $.get(url,"",function(data){
                    if(data.status == 1){
                        layer.msg(data.msg,{time:1500},function(){
                            window.location.reload();
                        });
                    }else{
                        layer.msg(data.msg,{time:3000},function(){

                        });
                    }
                });
            });
        })
    })

</script>
</body>

</html>