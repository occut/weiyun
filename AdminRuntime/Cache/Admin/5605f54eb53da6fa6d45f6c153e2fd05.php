<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<head>
    <meta charset="utf-8" />
    <title>微云控后台管理</title>
    <!-- layui.css -->
    <link href="<?php echo ($resource); ?>admin/plugin/layui/css/layui.css" rel="stylesheet" />
    <!-- font-awesome.css -->
    <link href="<?php echo ($resource); ?>admin/plugin/font-awesome/css/font-awesome.min.css" rel="stylesheet" />
    <!-- animate.css -->
    <link href="<?php echo ($resource); ?>admin/css/animate.min.css" rel="stylesheet" />
    <!-- 本页样式 -->
    <link href="<?php echo ($resource); ?>admin/css/main.css" rel="stylesheet" />
    <script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>

    <link rel="stylesheet" href="<?php echo ($resource); ?>bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="<?php echo ($resource); ?>dist/css/AdminLTE.min.css">
</head>
<body>
<div class="layui-layout layui-layout-admin">
    <!--顶部-->
    <div class="layui-header">
        <div class="ht-console">
            <div class="layui-main">
                <!--<a href="#" class="logo" style = "font-size: 24px; padding-top:5px;"><b>后台管理</b>v1.3</a>-->
                <!--<a href="#" class="logo" style = "font-size: 24px; padding-top:5px;">tom工作室(QQ群:516472075)</a>-->
            </div>
        </div>
        <!-- 顶部右侧菜单 -->
        <ul class="layui-nav top_menu">
            <li class="layui-nav-item" pc>
                <a href="javascript:;">
                    <!--<img src="images/face.jpg" class="layui-circle" width="35" height="35">-->
                    <cite>
                        <span>当前账户：</span>
                        <span class="hidden-xs"><?php echo (session('adminName')); ?></span>
                    </cite>
                </a>
                <dl class="layui-nav-child">
                    <dd> <a href="<?php echo U('Admin/listAdmins',array('gd'=>4,'md'=>67));?>">管理员</a></dd>
                    <dd> <a href="<?php echo U('Admin/listRoles',array('gd'=>4,'md'=>68));?>">角色</a></dd>
                    <dd>  <a href="<?php echo U('Admin/listModules',array('gd'=>4,'md'=>69));?>">模块</a></dd>
                    <dd> <a href="<?php echo U('Admin/editPassword',array('gd'=>4,'md'=>70));?>" >改密</a></dd>
                    <dd><a href="<?php echo U('Login/logout');?>" >退出</a></dd>
                </dl>
            </li>
            <li class="ht-nav-item layui-nav-item">
                <a href="javascript:;" id="individuation"><i class="fa fa-tasks fa-fw" style="padding-right:5px;"></i>个性化</a>
            </li>

        </ul>

    </div>
<!--侧边导航-->
<div class="layui-side">
    <section class="sidebar">
        <ul class="sidebar-menu layui-nav layui-nav-tree" lay-filter="test">
            <!--Start 进行循环，获得分组-->
            <?php if(is_array($menuGroup)): $i = 0; $__LIST__ = $menuGroup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li class="treeview layui-nav-item">
                    <a href="#">
                        <i class="fa fa-folder"></i> <span><?php echo ($vo["group_name"]); ?></span>
                    </a>
                    <ul class="treeview-menu layui-nav-child"<?php if(($vo["group_id"]) == $_SESSION['groupid']): ?>style="display:block"<?php endif; ?>>
                    <?php if(is_array($adminMenu)): $i = 0; $__LIST__ = $adminMenu;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$voo): $mod = ($i % 2 );++$i;?><!--如果父菜单和子菜单相等-->
                        <?php if(($vo["group_id"]) == $voo["group_id"]): if(is_array($moduleurl)): $i = 0; $__LIST__ = $moduleurl;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mo): $mod = ($i % 2 );++$i; if(($voo["menu_url"]) == $mo): ?><li <?php if(($voo["menu_id"]) == $_SESSION['menuid']): ?>class="active"<?php endif; ?>><a href="<?php echo U($voo['menu_url'],array('gd'=>$voo['group_id'],'md'=>$voo['menu_id']));?>"><i class="fa fa-circle-o"></i><?php echo ($voo["menu_name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
        </ul>
        </li><?php endforeach; endif; else: echo "" ;endif; ?>
        <!--END 进行循环，获得分组-->
        </ul>
    </section>
</div>
<!--收起导航-->
<div class="layui-side-hide layui-bg-cyan">
    <i class="fa fa-long-arrow-left fa-fw"></i>收起导航
</div>
<!--主体内容-->
<div class="layui-body">
    <div class="content-wrapper" style = "margin-left:1px ;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                IP地址管理
            </h1>
        </section>

        <div class="layui-field-box">
            <div id="dataContent" class="">
                <!--内容区域 ajax获取-->
                <div class="box-header">
                    <!--<a href="<?php echo U('Tasks/taskscreate');?>" class="layui-btn ">添加任务</a>-->
                    <h3 class="box-title layui-btn"><button class="btn layui-btn " onclick="delAll('<?php echo U('IpJudge/dells');?>')">批量删除</button></h3>
                    <!--<form class="layui-form"  style="float:right;width:350px;" action="<?php echo U('Tasks/listTasks');?>">-->
                        <!--<input style="float:left;width:200px;" type="text" name="title" required  lay-verify="required" placeholder="请输入任务名称或关键字" autocomplete="off" class="layui-input">-->
                        <!--<button style="float:right;width:100px;margin-right:20px;" class="layui-btn" lay-submit lay-filter="formDemo">搜索</button>-->
                    <!--</form>-->

                    <table style="" class="layui-table" lay-even="">
                        <thead>
                        <tr class="tng" >
                            <th style = "width:5%;text-align: center;"><input type="checkbox" id="dellAll" value=""></th>
                            <!--<th style = "width:5%;text-align: center;"><input type="checkbox" id="dellAll" value=""></th>-->
                            <th style="text-align: center;">ID</th>
                            <th style="text-align: center;">ip</th>
                            <th style="text-align: center;">设备ID</th>
                            <th style="text-align: center;">操作</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php if(is_array($tasks)): $i = 0; $__LIST__ = $tasks;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><tr class="tnd">
                                <td style="text-align: center;"><input type="checkbox" id="<?php echo ($vo["ip_id"]); ?>" value="<?php echo ($vo["ip_id"]); ?>" name="delAll"></td>
                                <td style="text-align: center;"><span><?php echo ($vo["ip_id"]); ?></span></td>
                                <td style="text-align: center;"><span><?php echo ($vo["ip_value"]); ?></span></td>
                                <td style="text-align: center;"><span><?php echo ($vo["ip_equipment"]); ?></span></td>
                                <td style="text-align: center;">
                                    <!--<a  href="<?php echo U('Tasks/edittimeTasks',array('time_id'=>$vo['time_id']));?>">编辑</a>-->
                                    <a  href="javascript:if(confirm('确实要删除吗?'))location='<?php echo U('IpJudge/dell',array('ip_id'=>$vo['ip_id']));?>'">删除</a>
                                </td>
                            </tr><?php endforeach; endif; else: echo "" ;endif; ?>
                        </tbody>
                    </table>
                    <div id="pageNav"></div>
                </div>
            </div>
            <div class="pagepadding">
                <div class="col-sm-5"><div aria-live="polite" role="status" id="example2_info" class="dataTables_info">共<?php echo ($count); ?>条</div></div><div class="col-sm-7"><div id="example2_paginate" class="dataTables_paginate paging_simple_numbers"><ul class="pagination"><?php echo ($page); ?></ul></div></div>
            </div>
        </div>
        <script>
            $(".input").change(function(data){

                var id = $(this).attr('data-node_id');
                var value = $(this).val();
                $.ajax({
                    url:"<?php echo U('Tasks/ip');?>",
                    type:"post",
                    dataType: "json",
                    data:{'time_id':id ,'ip':value },
                    async: "false",
                    success:function(result){
                        if(result == 1){
                            layer.msg("更新经纬度成功", { icon: 6 });
                            parent.location.reload();
                        }
                        if(result == 2){
                            layer.msg("更新经纬度失败", { icon: 5 });
                        }
                        if(result == 3){
                            layer.msg("当前任务已过期", { icon: 5 });
                        }
                    }
                })
            })
        </script>
        <script>
            $(document).ready(function () {
                var num = 1;
                var checkbox = $("input[type='checkbox'][name='delAll']");
                $('#dellAll').on('click',function () {
//                alert(123);
                    if (num%2){
                        $.each(checkbox, function(i, n){
                            checkbox[i].checked = true;
                        });
                    }else{
                        $.each(checkbox, function(i, n){
                            checkbox[i].checked = false;
                        });
                    }
                    num++;
                });
                $('.selectRule').on('click',function () {
                    var classname = $(this).children(".layui-form-checkbox")[0].className;
                    var classArr = classname.split(' ');
                    var checkbox = $(this).next('td').find("input[type='checkbox']");
                    if($.inArray('layui-form-checked',classArr) >= 0){
                        $.each(checkbox,function (i,n) {
                            checkbox[i].checked = true;
                        });
                        $(this).next('td').find(".layui-form-checkbox").addClass('layui-form-checked');
                    }else{
                        $.each(checkbox,function (i,n) {
                            checkbox[i].checked = false;
                        });
                        $(this).next('td').find(".layui-form-checkbox").removeClass('layui-form-checked');
                    }
                });

            });
        </script>
        <!--底部信息-->
<div class="layui-footer">
    <!--<p style="line-height:44px;text-align:center;">Copyright &copy; 2012-2016 微云控云控管理系统</p>-->
    <p style="line-height:44px;text-align:center;">tom工作室(QQ群:516472075)</p>
</div>
<!--个性化设置-->
<div class="individuation animated flipOutY layui-hide">
    <ul>
        <li><i class="fa fa-cog" style="padding-right:5px"></i>个性化</li>
    </ul>
    <div class="explain">
        <small>从这里进行系统设置和主题预览</small>
    </div>
    <div class="setting-title">设置</div>
    <div class="setting-item layui-form">
        <span>侧边导航</span>
        <input type="checkbox" lay-skin="switch" lay-filter="sidenav" lay-text="ON|OFF" checked>
    </div>
    <!--<div class="setting-item layui-form">-->
    <!--<span>管家提醒</span>-->
    <!--<input type="checkbox" lay-skin="switch" lay-filter="steward" lay-text="ON|OFF" checked>-->
    <!--</div>-->
    <div class="setting-title">主题</div>
    <div class="setting-item skin skin-default" data-skin="skin-default">
        <span>低调优雅</span>
    </div>
    <div class="setting-item skin skin-deepblue" data-skin="skin-deepblue">
        <span>蓝色梦幻</span>
    </div>
    <div class="setting-item skin skin-pink" data-skin="skin-pink">
        <span>姹紫嫣红</span>
    </div>
    <div class="setting-item skin skin-green" data-skin="skin-green">
        <span>一碧千里</span>
    </div>
</div>
</div>
<!-- layui.js -->
<script src="<?php echo ($resource); ?>admin/plugin/layui/layui.js"></script>
<script src="<?php echo ($resource); ?>js/script123.js"></script>
<script src="<?php echo ($resource); ?>plugins/jQuery/jQuery-2.2.0.min.js"></script>

<script src="<?php echo ($resource); ?>dist/js/app.min.js"></script>
<script src="<?php echo ($resource); ?>bootstrap/js/bootstrap.min.js"></script>
<script>
//    $(function () {
//        $("#example1").DataTable();
//        $('#example2').DataTable({
//            "paging": true,
//            "lengthChange": false,
//            "searching": false,
//            "ordering": true,
//            "info": true,
//            "autoWidth": false
//        });
//    });

//    $('.some_class').datetimepicker();

</script>
<!-- layui规范化用法 -->
<script type="text/javascript">
    layui.config({
        base: '<?php echo ($resource); ?>admin/js/'
    }).use('main');
</script>
</body>
</html>
        <script>
            $(document).ready(function () {
                var num = 1;
                var checkbox = $("input[type='checkbox'][name='delAll']");
                $('#dellAll').on('click',function () {
//                alert(123);
                    if (num%2){
                        $.each(checkbox, function(i, n){
                            checkbox[i].checked = true;
                        });
                    }else{
                        $.each(checkbox, function(i, n){
                            checkbox[i].checked = false;
                        });
                    }
                    num++;
                });
                $('.selectRule').on('click',function () {
                    var classname = $(this).children(".layui-form-checkbox")[0].className;
                    var classArr = classname.split(' ');
                    var checkbox = $(this).next('td').find("input[type='checkbox']");
                    if($.inArray('layui-form-checked',classArr) >= 0){
                        $.each(checkbox,function (i,n) {
                            checkbox[i].checked = true;
                        });
                        $(this).next('td').find(".layui-form-checkbox").addClass('layui-form-checked');
                    }else{
                        $.each(checkbox,function (i,n) {
                            checkbox[i].checked = false;
                        });
                        $(this).next('td').find(".layui-form-checkbox").removeClass('layui-form-checked');
                    }
                });

            });

        </script>

        <script>
            function ishide(obj,id){
                var b= $(obj).html();
                console.log(b);
                console.log(id);
                if(b =="开始任务"){
                    var c =1
                }
                else if(b=="关闭任务"){
                    var c = 0
                }
                $.ajax({
                    url:"<?php echo U('Tasks/isHidden');?>",
                    type:"post",
                    dataType: "json",
                    data:{'time_id':id ,'time_status':c },
                    async: "false",
                    success:function(result){
                        if(result == 1){
                            layer.msg("更新状态成功", { icon: 6 });
                            parent.location.reload();
                        }
                        if(result == 2){
                            layer.msg("更新状态失败", { icon: 5 });
                        }
                        if(result == 3){
                            layer.msg("当前任务已过期", { icon: 5 });
                        }
                    }
                })
            }
            function isstate(obj,aid){
                var b= $(obj).html();
                console.log(aid);
                var c = 0;
                $.ajax({
                    url:"<?php echo U('Article/isHidden');?>",
                    type:"post",
                    dataType: "json",
                    data:{'articleid':aid ,'ishidden':c },
                    async: "false",
                    success:function(ishiddens){
                        layer.alert("重启中",{ icon: 1,skin: 'layer-ext-moon' },function(){
                            location.reload();
                        });
//                if(b=="开始任务"){
//                    $(obj).html('关闭任务');
//                    $(obj).css('color','red');
//                }
                        if(b=="关闭任务"){
                            $(obj).html('开始任务');
                            $(obj).css('color','#3c8dbc');
                        }
                    }

                })

            }

        </script>