<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="renderer" content="webkit">
    <meta http-equiv="Cache-Control" content="no-siteapp" />
    <title>后台管理系统 - 主页</title>
    <link rel="shortcut icon" href="/favicon.ico">
    <link href="/style/css/bootstrap.min.css?v=3.3.1" rel="stylesheet">
    <link href="/style/css/font-awesome.min.css?v=4.4.0" rel="stylesheet">
    <link href="/style/css/animate.min.css" rel="stylesheet">
    <link href="/style/css/style.css?v=<?php echo \Illuminate\Support\Facades\Config::get('constants.ADMIN_CSS_JS_VERSION');?>" rel="stylesheet">
</head>

<body class="fixed-sidebar full-height-layout gray-bg" style="overflow:hidden">
<div id="wrapper">
    <!--左侧导航开始-->
    <nav class="navbar-default navbar-static-side" role="navigation">
        <div class="nav-close"><i class="fa fa-times-circle"></i>
        </div>
        <div class="sidebar-collapse">
            <ul class="nav" id="side-menu">
                <li>
                    <a class="J_menuItem" href="{{URL::route('index.welcome')}}"> <span class="nav-label">网站首页</span></a>
                </li>
            @if($admin_id)
                @foreach($navigation as $key=> $value)
                    <li>
                        <a href="#">
                            <span class="nav-label">{{$key}}</span>
                            <span class="fa arrow"></span>
                        </a>
                        <ul class="nav nav-second-level">
                            @foreach($value as $k => $v)
                                @if($v['status']==0)
                                <li>
                                    <a class="J_menuItem" href="{{URL::route('admin.rule-error')}}">{{$v['name']}}</a>
                                </li>
                                @elseif($v['status']==1)
                                <li>
                                    @if($v['parameter'])
                                        <a class="J_menuItem" href="{{ URL::route($v['url'],$v['parameter']) }}">{{$v['name']}}</a>
                                    @else
                                        <a class="J_menuItem" href="{{ URL::route($v['url']) }}">{{$v['name']}}</a>
                                    @endif
                                </li>
                                @endif
                            @endforeach
                        </ul>
                    </li>
                @endforeach
            @endif
            @if($admin_id == '1')
                <li>
                    <a>
                        <span class="nav-label">管理员管理</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        <li>
                            <a class="J_menuItem" href="{{URL::route('admin.rule-route')}}">路由管理</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{URL::route('admin.admin-group')}}">分组管理</a>
                        </li>
                        <li>
                            <a class="J_menuItem" href="{{URL::route('admin.index')}}">管理员</a>
                        </li>
                    </ul>
                </li>
                @endif
            </ul>
        </div>
    </nav>
    <!--左侧导航结束-->
    <!--右侧部分开始-->
    <div id="page-wrapper" class="gray-bg dashbard-1">
        <div class="row border-bottom">
            <nav class="navbar navbar-static-top" role="navigation" style="margin-bottom: 0">
                <ul class="nav navbar-top-links navbar-right">
                    <li class="dropdown profile-dropdown">
                        <div class="dropdown profile-element">
                            <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                                <span class="clear">
                                <span class="text-muted text-xs block">{{$adminusername}}<b class="caret"></b></span>
                                </span>
                            </a>
                            <ul class="dropdown-menu animated fadeInRight m-t-xs">
                                <li>
                                    <a class="J_menuItem" href="{{URL::route('admin.editor',['admin_id'=>$admin_id])}}">管理员资料</a>
                                </li>
                                <li class="divider"></li>
                                <li><a href="{{ URL::route('login.loginout') }}">安全退出</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </nav>
        </div>
        <div class="row content-tabs">
            <button class="roll-nav roll-left J_tabLeft"><i class="fa fa-backward"></i>
            </button>
            <nav class="page-tabs J_menuTabs">
                <div class="page-tabs-content">
                    <a href="{{URL::route('index.index')}}" class="active J_menuTab" data-id="">首页</a>
                </div>
            </nav>
            <button class="roll-nav roll-right J_tabRight"><i class="fa fa-forward"></i>
            </button>
            <div class="btn-group roll-nav roll-right">
                <button class="dropdown J_tabClose" data-toggle="dropdown">关闭操作<span class="caret"></span>

                </button>
                <ul role="menu" class="dropdown-menu dropdown-menu-right">
                    <li class="J_tabShowActive"><a>定位当前选项卡</a>
                    </li>
                    <li class="divider"></li>
                    <li class="J_tabCloseAll"><a>关闭全部选项卡</a>
                    </li>
                    <li class="J_tabCloseOther"><a>关闭其他选项卡</a>
                    </li>
                </ul>
            </div>
            <a href="{{ URL::route('login.loginout') }}" class="roll-nav roll-right J_tabExit"><i class="fa fa fa-sign-out"></i> 退出</a>
        </div>
        <div class="row J_mainContent" id="content-main">
            <iframe class="J_iframe" name="iframe0" width="100%" height="100%" src="{{ URL::route('index.welcome') }}" frameborder="0" data-id="index_v2.html" seamless>

            </iframe>
        </div>
        <div class="footer">
            
        </div>
    </div>
    <!--右侧部分结束-->
</div>
<script src="/style/js/jquery.min.js?v=2.1.4"></script>
<script src="/style/js/bootstrap.min.js?v=3.3.7"></script>
<script src="/style/js/plugins/metisMenu/jquery.metisMenu.js"></script>
<script src="/style/js/plugins/slimscroll/jquery.slimscroll.min.js"></script>
<script src="/style/js/plugins/layer/layer.min.js"></script>
<script src="/style/js/hplus.min.js?v=4.0.0"></script>
<script type="text/javascript" src="/style/js/contabs.min.js"></script>
<script src="/style/js/plugins/pace/pace.min.js"></script>
</body>

</html>