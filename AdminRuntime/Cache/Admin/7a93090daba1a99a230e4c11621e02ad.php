<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="<?php echo ($resource); ?>admin/plugin/layui/css/layui.css" rel="stylesheet" />
    <title>导入文件</title>
</head>
<body>
<br/>
<form class="layui-form" action="<?php echo U('Wechat/Import');?>" method="post">
    <div class="layui-form-item layui-form-text">
        <label class="layui-form-label">文本域</label>
        <div class="layui-input-block">
            <textarea name="desc" placeholder="请输入内容"  class="layui-textarea" style = "height:300px;"></textarea>
            <div class="layui-form-mid layui-word-aux">示例：用户----密码----数据</div>
        </div>

    </div>
    <div class="layui-form-item">
        <div class="layui-input-block">
            <button  class="layui-btn btn-submit logSubmit" lay-submit lay-filter="signIn">
                提交</button>
            <button type="reset" class="layui-btn layui-btn-primary">重置</button>
        </div>
    </div>
</form>
<script type="text/javascript" src="<?php echo ($resource); ?>layui/layui.js"></script>
<script src="<?php echo ($resource); ?>js/script123.js"></script>
<script>
    //Demo
        //监听提交
    layui.use(['form'],function () {
        $ = layui.jquery;
        var form = layui.form();
        form.on('submit(signIn)',function (data) {

            var result = post(data.form.action,data.field);
            console.log(result);
            if(result == 1){
                layer.msg("添加成功", { icon: 6 });
                layer.closeAll('page');
                layer.alert("添加成功",{ icon: 1,skin: 'layer-ext-moon' },function(){
                    parent.location.reload();
                });
            }else{
                layer.alert("添加失败",{icon:2, skin:'layer-ext-moon' },function () {
                    location.reload();
                });
            }
            return false;
        });
    });
</script>
</body>
</html>