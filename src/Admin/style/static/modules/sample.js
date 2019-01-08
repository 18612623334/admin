/** layuiAdmin.std-v1.0.0 LPPL License By http://www.layui.com/admin/ */ ;
layui.define(function(e) {
    var a = layui.admin;
    layui.use(["admin", "carousel"], function() {
        var e = layui.$,
            a = (layui.admin, layui.carousel),
            l = layui.element,
            t = layui.device();
        e(".layadmin-carousel").each(function() {
            var l = e(this);
            a.render({
                elem: this,
                width: "100%",
                arrow: "none",
                interval: l.data("interval"),
                autoplay: l.data("autoplay") === !0,
                trigger: t.ios || t.android ? "click" : "hover",
                anim: l.data("anim")
            })
        }), l.render("progress")
    }), layui.use(["carousel", "echarts"], function() {
    	$.ajax({
            type: "POST",
            url: "http://admin.ibangoo.com/index/get-echart",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            dataType: "json",
            success: function (data) {
                if (data.status=="1") {
                    var e = layui.$,
				        a = (layui.carousel, layui.echarts),
				        l = [],
				        t = [{
				            tooltip: {
				                trigger: "axis"
				            },
				            calculable: !0,
				            legend: {
				                data: ["访问量", "下载量"]
				            },
				            xAxis: [{
				                type: "category",
				                data: ["1月", "2月", "3月", "4月", "5月", "6月", "7月", "8月", "9月", "10月", "11月", "12月"]
				            }],
				            yAxis: [{
				                type: "value",
				                name: "访问量",
				                axisLabel: {
				                    formatter: "{value}"
				                }
				            }, {
				                type: "value",
				                name: "下载量",
				                axisLabel: {
				                    formatter: "{value}"
				                }
				            }],
				            series: [{
				                name: "访问量",
				                type: "line",
				                data: data.data.visit
				            }, {
				                name: "下载量",
				                type: "line",
				                yAxisIndex: 1,
				                data: data.data.download
				            }]
				        }],
				        i = e("#LAY-index-pagetwo").children("div"),
				        n = function(e) {
				            l[e] = a.init(i[e], layui.echartsTheme), l[e].setOption(t[e]), window.onresize = l[e].resize
				        };
				    i[0] && n(0)
                } else {
                    layer.msg(msg.msg);
                }
            }
        }, "json");
    })
});