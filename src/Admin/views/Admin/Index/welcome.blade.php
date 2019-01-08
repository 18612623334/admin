@extends('admin.base')

@section('content')
    <div class="layui-row layui-col-space15">

        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">
                    访问量
                    <span class="layui-badge layui-bg-blue layuiadmin-badge">周</span>
                </div>
                <div class="layui-card-body layuiadmin-card-list">
                    <p class="layuiadmin-big-font">9,999,666</p>
                    <p>总计访问量
                        <span class="layuiadmin-span-color">88万 <i class="layui-inline layui-icon layui-icon-flag"></i></span>
                    </p>
                </div>
            </div>
        </div>

        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">
                    下载
                    <span class="layui-badge layui-bg-cyan layuiadmin-badge">月</span>
                </div>
                <div class="layui-card-body layuiadmin-card-list">
                    <p class="layuiadmin-big-font">33,555</p>
                    <p>总计下载量
                        <span class="layuiadmin-span-color">100,000,000 <i class="layui-inline layui-icon layui-icon-face-smile-b"></i></span>
                    </p>
                </div>
            </div>
        </div>

        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">
                    收入
                    <span class="layui-badge layui-bg-green layuiadmin-badge">年</span>
                </div>
                <div class="layui-card-body layuiadmin-card-list">
                    <p class="layuiadmin-big-font">999,666</p>
                    <p>总计收入
                        <span class="layuiadmin-span-color">200,000,000 <i class="layui-inline layui-icon layui-icon-dollar"></i></span>
                    </p>
                </div>
            </div>
        </div>

        <div class="layui-col-sm6 layui-col-md3">
            <div class="layui-card">
                <div class="layui-card-header">
                    活跃用户
                    <span class="layui-badge layui-bg-orange layuiadmin-badge">月</span>
                </div>
                <div class="layui-card-body layuiadmin-card-list">
                    <p class="layuiadmin-big-font">66,666</p>
                    <p>总计用户
                        <span class="layuiadmin-span-color">980,254 <i class="layui-inline layui-icon layui-icon-user"></i></span>
                    </p>
                </div>
            </div>
        </div>

        <div class="layui-col-sm12">
            <div class="layui-card">
                <div class="layui-card-header">
                    访问量
                </div>
                <div class="layui-card-body">
                    <div class="layui-row">
                        <div class="layui-col-sm8">
                            <div class="layui-carousel layadmin-carousel layadmin-dataview" data-anim="fade" lay-filter="LAY-index-pagetwo">
                                <div carousel-item id="LAY-index-pagetwo">
                                    <div><i class="layui-icon layui-icon-loading1 layadmin-loading"></i></div>
                                </div>
                            </div>
                        </div>
                        <div class="layui-col-sm4">
                            <div class="layuiadmin-card-list">
                                <p class="layuiadmin-normal-font">月访问数</p>
                                <span>同上期增长</span>
                                <div class="layui-progress layui-progress-big" lay-showPercent="yes">
                                    <div class="layui-progress-bar" lay-percent="30%"></div>
                                </div>
                            </div>

                            <div class="layuiadmin-card-list">
                                <p class="layuiadmin-normal-font">月下载数</p>
                                <span>同上期增长</span>
                                <div class="layui-progress layui-progress-big" lay-showPercent="yes">
                                    <div class="layui-progress-bar" lay-percent="20%"></div>
                                </div>
                            </div>

                            <div class="layuiadmin-card-list">
                                <p class="layuiadmin-normal-font">月收入</p>
                                <span>同上期增长</span>
                                <div class="layui-progress layui-progress-big" lay-showPercent="yes">
                                    <div class="layui-progress-bar" lay-percent="25%"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        layui.use(['index', 'sample']);
    </script>
@endsection