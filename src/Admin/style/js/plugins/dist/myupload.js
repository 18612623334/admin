/**
 * Created by Administrator on 2018/8/22.
 */
$(function(){

    var uploader = WebUploader.create({
        // swf文件路径
        swf: 'Uploader.swf',
        chunked: true, //分片处理大文件
        chunkSize: 1024 * 1024,
        chunkRetry: 100,         // 如果遇到网络错误,重新上传次数
        threads: 2,              //上传并发数。允许同时最大上传进程数。
        // 文件接收服务端。
        server: '/public/uploadChunkFile',
        headers:{'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
        fileSizeLimit: 5*1024*1024,

        // 选择文件的按钮。可选。
        // 内部根据当前运行是创建，可能是input元素，也可能是flash.
        pick: '.picker',

        // 不压缩image, 默认如果是jpeg，文件上传前会压缩一把再上传！
        resize: false,
        // 只允许选择图片文件。
        accept: mimetypes,
        auto: false,
        duplicate :true
    });

    uploader.on("error", function (type) {
        if (type == "Q_TYPE_DENIED") {
            layer.msg(fileType);
        } else if (type == "Q_EXCEED_SIZE_LIMIT") {
            layer.msg("文件大小不能超过5M");
        }else {
            layer.msg("上传出错！请检查后重新上传！错误代码"+type);
        }

    });

    // 当有文件被添加进队列的时候
    uploader.on( 'fileQueued', function( file ) {
        var block_info=[];
        uploader.md5File(file).
        then(function (fileMd5) {
            file.wholeMd5 = fileMd5;
            file_md5 = fileMd5;
            $.ajax({
                type: "POST",
                url: "/public/checkHasFile",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                data: {md5: file_md5},
                dataType: "json",
                success: function (msg) {
                    switch (msg.code) {
                        // 断点
                        case '0':
                            for (var i in msg.block_info) {
                                block_info.push(msg.block_info[i]);
                            }
                            file.status = 0;
                            break;
                        // 无断点
                        case '1':
                            file.status = 1;
                            break;
                    }
                    uploader.upload();
                }
            }, "json");

        });

    });
    uploader.on('uploadProgress', function (file, percentage) {
        index = layer.load(1, {
            shade: [0.1,'#fff'] //0.1透明度的白色背景
        });
    });
    uploader.on( 'uploadSuccess', function( file ) {
        //console.log(file);
        $.ajax({
            type: "POST",
            url: "/public/mergeFile",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            data: { md5: file.wholeMd5, fileName: file.name },
            dataType: "json",
            success: function (msg) {
                callbackfun(msg.status,msg.data);
            }
        }, "json");

    });

    uploader.on( 'uploadError', function( file ) {
        //alert('上传出错');
        //$( '#'+file.id ).find('p.state').text('上传出错');
    });

    uploader.on( 'uploadComplete', function( file ) {
        //alert('xxxxxxxx');
        //$( '#'+file.id ).find('.progress').fadeOut();
    });
    // 上传出错处理
    uploader.on('uploadError', function (file) {
        uploader.retry();
    });
});

