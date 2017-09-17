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

<!-- Left side column. contains the logo and sidebar -->
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
                        <?php if(($vo["group_id"]) == $voo["group_id"]): if(is_array($moduleurl)): $i = 0; $__LIST__ = $moduleurl;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$mo): $mod = ($i % 2 );++$i; if(($voo["menu_url"]) == $mo): ?><li <?php if(($voo["menu_id"]) == $_SESSION['menuid']): ?>class="active"<?php endif; ?>><a href="<?php echo U($voo['menu_url'],array('gd'=>$voo['group_id'],'md'=>$voo['menu_id']));?>"><i class="fa fa-circle-o"></i> <?php echo ($voo["menu_name"]); ?></a></li><?php endif; endforeach; endif; else: echo "" ;endif; endif; endforeach; endif; else: echo "" ;endif; ?>
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
<link rel="stylesheet" href="<?php echo ($resource); ?>bootstrap/css/bootstrap.min.css">
<!-- Font Awesome -->
<!--<link rel="stylesheet" href="<?php echo ($resource); ?>css/font-awesome.min.css">-->
<!-- Ionicons -->
<!--<link rel="stylesheet" href="<?php echo ($resource); ?>css/ionicons.min.css">-->
<!-- Theme style -->
<link rel="stylesheet" href="<?php echo ($resource); ?>dist/css/AdminLTE.min.css">

<!--引用编辑器-->
<script type="text/javascript" src="<?php echo ($resource); ?>editor/ueditor.config.js"></script>
<!-- 编辑器源码文件 -->
<script type="text/javascript" src="<?php echo ($resource); ?>editor/ueditor.all.js"></script>
<!-- 实例化编辑器 -->
<script type="text/javascript">
    var ue = UE.getEditor('container');
</script>
<!--引用编辑器-->
<!-- Content Wrapper. Contains page content -->
<div class="layui-body">
    <div class="content-wrapper" style = "margin-left:1px ;">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <h1>
                编辑任务
            </h1>
        </section>

        <!-- Main content -->
        <section class="content">
            <div class="row">
                <div class="col-xs-12">
                    <div class="nav-tabs-custom">
                        <ul class="nav nav-tabs">
                            <li class="active"><a href="#fa-icons" data-toggle="tab">基本设置</a></li>
                            <li><a href="#seoInfor" data-toggle="tab">seo信息</a></li>
                            <li><a href="#auxiliaryInfor" data-toggle="tab">附属信息</a></li>
                        </ul>
                        <div class="tab-content">
                            <!--start 基本配置 -->
                            <div class="tab-pane active" id="fa-icons">
                                <section id="new">
                                    <div class="row fontawesome-icon-list">
                                        <form id="formOne" role="form" method="post" action="<?php echo U('Tasks/edittasks');?>" enctype="multipart/form-data">
                                            <div class="box-body" style="margin-left:15px;">
                                                <div class="form-group">
                                                    <label>任务名称</label>
                                                    <select class="form-control" name="tasksid">
                                                        <option value="<?php echo ($tasks["tasks_id"]); ?>"  value="<?php echo ($tasks["tasks_name"]); ?>"><?php echo ($tasks["tasks_name"]); ?></option>
                                                    </select>
                                                    <input type="hidden" name="taskname" value="<?php echo ($tasks["tasks_name"]); ?>"/>
                                                </div>
                                                <div class="form-group" id="listAllConfigs">
                                                </div>
                                                <!-- /.form group -->
                                                <?php if(($navname) == ""): else: ?>
                                                    <div class="form-group" id="main" style="border:1px dotted red;padding:3px;">
                                                        <label for="articlepic">任务缩略图</label>
                                                        <input type='file' name='tasks[]' id='tasks'/>
                                                        <button type="submit" class="btn btn-primary" onclick="return setformurl()">提交</button>
                                                        <p style="color:red">如果上传图片，请先上传</p>
                                                    </div>
                                                    <script>
                                                        function setformurl(){
                                                            //alert("上传成功");
                                                            document.getElementById("formOne").action = "<?php echo U('Tasks/Upload');?>?taskid=<?php echo ($tasks["tasks_id"]); ?>";
                                                            return true;
                                                        }
                                                    </script><?php endif; ?>
                                                <div class="form-group">
                                                    <label>设备分组</label>
                                                    <select class="form-control" name="tasksgroupid">
                                                        <?php if(is_array($tasksgroup)): $i = 0; $__LIST__ = $tasksgroup;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$tasksgroup): $mod = ($i % 2 );++$i;?><option value="<?php echo ($tasksgroup["group_id"]); ?>"><?php echo ($tasksgroup["group_name"]); ?></option><?php endforeach; endif; else: echo "" ;endif; ?>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <label>下单量</label>
                                                    <div class="radio">
                                                        <input type="text" name="tasksnumber" value="<?php echo ($tasks["tasks_number"]); ?>">
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <label for="exampleInputEmail1">任务状态</label>
                                                    <div class="radio">
                                                        <label>
                                                            <input type="radio" name="taskstutas" class="iradio_flat-green" value="0" <?php if(($tasks["tasks_status"]) == "0"): ?>checked<?php endif; ?>>开启
                                                        </label>
                                                        <label>
                                                            <input type="radio" name="taskstutas" class="flat-red" value="1" <?php if(($tasks["tasks_status"]) == "1"): ?>checked<?php endif; ?>>关闭
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <!-- /.box-body -->
                                    </div>
                                    <div class="box-footer">
                                        <input type="hidden" name="configid" value="<?php echo ($webconfig["config_id"]); ?>">
                                        <button type="submit" class="btn btn-primary">提交</button>
                                    </div>
                                </section>
                            </div>
                            <!-- end基本配置 -->
                            <!-- start seo信息-->
                            <div class="tab-pane" id="seoInfor">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="articletitle">任务标题</label>
                                        <input type="text" value="111" class="form-control" name="articletitle" value="" id="articletitle" placeholder="请输入任务标题">
                                    </div>
                                    <div class="form-group">
                                        <label for="articlekeywords">任务关键字</label>
                                        <input type="text" class="form-control" name="articlekeywords" value="" id="articlekeywords" placeholder="请输入任务关键字">
                                    </div>
                                    <div class="form-group">
                                        <label for="articledescription">任务描述</label>
                                        <textarea class="form-control" rows="3"id="articledescription" placeholder="请输入任务描述" name="articledescription"></textarea>
                                    </div>
                                </div>
                                <div class="box-footer">
                                    <input type="hidden" name="configid" value="<?php echo ($webconfig["config_id"]); ?>">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                            </div> <!-- end seo信息-->
                            <!-- start 上传设置--><div class="tab-pane" id="auxiliaryInfor">
                            <div class="box-body">
                                <!-- radio -->
                                <!--logo-->
                                <div class="form-group">
                                    <label for="articlepic">任务缩略图</label>
                                    <input type="file" name="articlepic" id="articlepic">
                                    <p class="help-block">图片上传的大小不应大于3M</p>
                                </div>
                                <!--logo-->
                                <div class="form-group">
                                    <label for="articlebrowse">浏览量</label>
                                    <input type="text" class="form-control" name="articlebrowse" value="" id="articlebrowse" placeholder="请输入浏览量">
                                </div>
                                <div class="form-group">
                                    <label for="articleclicks">点击次数</label>
                                    <input type="text" class="form-control" name="articleclick" value="" id="articleclicks" placeholder="请输入点击次数">
                                </div>
                                <div class="form-group">
                                    <label for="articleauthor">作者</label>
                                    <input type="text" class="form-control" name="articleauthor" value=""  id="articleauthor" placeholder="请输入任务作者">
                                </div>
                                <div class="form-group">
                                    <label>发布时间:</label>
                                    <div>
                                        <input type="text" class="some_class form-control" name="articleaddtime" placeholder="不填默认为当前时间">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="articlesummary">任务摘要</label>
                                    <input type="text" class="form-control" name="articlesummary" value="" id="articlesummary" placeholder="请输入任务摘要">
                                </div>
                            </div>
                            <!-- /.box-body -->
                            <div class="box-footer">
                                <input type="hidden" name="configid" value="<?php echo ($webconfig["config_id"]); ?>">
                                <button type="submit" class="btn btn-primary">提交</button>
                            </div>
                        </div> <!-- end 上传设置-->
                            <!-- /#ion-icons -->
                        </div>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.nav-tabs-custom -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </section>
        <!-- /.content -->
    </div>

<!-- /.content-wrapper -->
</div>
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
<script>
    $.widget.bridge('uibutton', $.ui.button);
</script>
<script src="<?php echo ($resource); ?>dist/js/app.min.js"></script>
<script src="<?php echo ($resource); ?>bootstrap/js/bootstrap.min.js"></script>
<script>
    $(function () {
        $("#example1").DataTable();
        $('#example2').DataTable({
            "paging": true,
            "lengthChange": false,
            "searching": false,
            "ordering": true,
            "info": true,
            "autoWidth": false
        });
    });

    $('.some_class').datetimepicker();

</script>
<!-- layui规范化用法 -->
<script type="text/javascript">
    layui.config({
        base: '<?php echo ($resource); ?>admin/js/'
    }).use('main');
</script>
</body>
</html>
<script src="<?php echo ($resource); ?>bootstrap/js/bootstrap.min.js"></script>
<script>

 function setTaskConfig(taskId){
	 $.ajax({
	     url:"<?php echo U('Tasks/getConfigsEdit');?>",
	     type:"post",
	     dataType: "json",
	     data:{'taskid': taskId  },
	     async: "false",
	     success:function(result){
			 //alert(result.content);
	         $("#listAllConfigs").html(result.content);

	     }

	 })
 }
 
 
 var taskId = '<?php echo ($tasks["tasks_id"]); ?>';

 if(taskId != ''){
	 setTaskConfig('<?php echo ($tasks["tasks_id"]); ?>');
 }


</script>