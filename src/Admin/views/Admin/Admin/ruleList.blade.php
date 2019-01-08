<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" href="favicon.ico">
    <link href="/style/css/bootstrap.min.css?v=3.3.7" rel="stylesheet">
    <link href="/style/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
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
                        <div class="col-sm-3" style="float: right;">
                            <div class="input-group">
                                <span class="input-group-btn">
                                    <a target="_self" href="{{ URL::route('admin.route-editor',['naviagtion_id'=>$id]) }}">
                                        <button type="button" class="btn btn-sm btn-primary add">
                                            新增路由信息
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
                            <th>路由名称</th>
                            <th>路由地址</th>
                            <th>是否显示</th>
                            <th>创建时间</th>
                            <th>操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($list as $value)
                            <tr class="gradeX">
                                <td>{{$value['id']}}</td>
                                <td>{{$value['name']}}</td>
                                <td>{{$value['url']}}</td>
                                <td>
                                    @if($value['status'] == '1')
                                        显示
                                    @else
                                        不显示
                                    @endif
                                </td>
                                <td>{{$value['created_at']}}</td>
                                <td class="center">
                                    <a target="_self" href="{{URL::route('admin.route-editor',['id'=>$value['id'],'naviagtion_id'=>$value['naviagtion_id']])}}">编辑</a>
                                </td>
                            </tr>
                        @endforeach
                    </table>
                    <div class="row">
                        <div class="col-sm-6" style="width: 100%;">
                            <div style="float: left;" class="dataTables_paginate paging_simple_numbers" id="editable_paginate">
                                <?php echo $list->appends($_GET)->render(); ?>
                            </div>
                        </div>
                    </div>
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

<script>
    $(function(){
        $('.change_status').click(function(){
            var tdEle = $(this);
            var url = tdEle.data("href");
            layer.confirm('您确定要改变荣誉状态吗？', {
                btn: ['确定','取消']
            }, function(){
                $.get(url,"",function(data){
                    if(data.status == 1){
                        layer.msg(data.msg,{time:1500},function(){
                            window.location.href = "";
                        });
                    }else{
                        layer.msg(data.msg,{time:3000},function(){
                        });
                    }
                });
            });
        });
    });
</script>
<script type="text/javascript" src="http://tajs.qq.com/stats?sId=9051096" charset="UTF-8"></script>
</body>
</html>