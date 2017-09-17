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
            编辑配置

        </h1>
        <!--<ol class="breadcrumb">-->
            <!--<li><i class="fa fa-dashboard"></i> 首页</li>-->
            <!--<li>信息管理</li>-->
            <!--<li class="active">配置管理</li>-->
        <!--</ol>-->
    </section>
    <section class="content">
        <div class="row">
            <div class="col-xs-12">
                <div class="nav-tabs-custom">
                    <ul class="nav nav-tabs">
                        <li class="active"><a href="#fa-icons" data-toggle="tab">基本设置</a></li>
                        <!--<li><a href="#seoInfor" data-toggle="tab">seo信息</a></li>-->
                    </ul>
                    <div class="tab-content">
                        <!--start 基本配置 -->
                        <div class="tab-pane active" id="fa-icons">
                            <section id="new">
                                <form action="<?php echo U('Navigation/editNavigation');?>" method="post">
                                    <div class="box-body">
                                        <input type="hidden" name="navid" value="<?php echo ($navigation["nav_id"]); ?>">
                                        <!--配置名-->
                                        <div class="form-group">
                                            <label for="username">任务名称</label>
                                            <input type="text" class="form-control" name="navname"  value="<?php echo ($navigation["nav_name"]); ?>"  autofocus id="username" placeholder="请输入广告位置">
                                        </div>
                                        <!-- /.form-group -->
                                        <!--父级配置名称-->
                                        <div class="form-group" style="display: none">
                                            <label>父配置名称</label>
                                            <select class="form-control" name="parentid">
                                                <option value="<?php echo ($navigation["parent_id"]); ?>"><?php echo ($parentnavigation["nav_name"]); ?></option>
                                                <option value="0" <?php if(($navigation["parent_id"]) == "0"): ?>selected<?php endif; ?>>顶级行业</option>
                                                <?php echo getnavigationtypeoptions(0,0,I('navid'));?>
                                            </select>
                                        </div>
                                        <!--排序-->
                                        <div class="form-group">
                                            <label for="articledescription">参数配置</label>
                                            <textarea class="form-control" rows="3" id="navorder"  name="navtitle"><?php echo ($navigation["nav_title"]); ?></textarea>
                                        </div>

                                        <!--是否是外部链接-->
                                        <div class="form-group" >
                                            <label for="exampleInputEmail1">附带图片</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="isout" id="inner" class="iradio_flat-green" value="0" <?php if(($navigation["is_out"]) == "0"): ?>checked<?php endif; ?>>是

                                                </label>
                                                <label>
                                                    <input type="radio" name="isout" id="out" class="flat-red" value="1" <?php if(($navigation["is_out"]) == "1"): ?>checked<?php endif; ?>>否
                                                </label>
                                            </div>
                                        </div>
										<!--当is_out为0时-->
                                        <!--内部链接    -->
                                        <?php if(($navigation["is_out"]) == "0"): ?><div class="form-group" id="isinner" >
                                                    <input class="form-control" placeholder="请选择URl" id="innername" name="navigationurl" type="text" value="<?php echo ($navigation["nav_url"]); ?>" >
                                                    <input name="urlnum" class="form-control" type="text" id="innernum" placeholder="请选择图片张数" value="<?php echo ($navigation["url_num"]); ?>">
                                                </div>
                                            </div>

                                            <div class="form-group" id="isout" style="display: none">
                                                <!--<input type="text"  class="form-control"  value="http://">-->
                                            </div>
                                            <?php else: ?>



                                            <div class="form-group" id="isinner"  style="display: none">
                                             		<input name="urlnum" class="form-control" type="text" value="" id="innernum" placeholder="请选择图片张数" value="">
                                                    <input class="form-control" placeholder="请选择URL"  type="text" name="navigationurl" id="innername" readonly="readonly"  style="background-color: white">
                                                    <input type="hidden"  id="innerurl" value="<?php echo ($navigation["nav_url"]); ?>">

                                            </div>

                                            <div class="form-group" id="isout">

                                            </div><?php endif; ?>


                                        <!--是否在新页面打开-->
                                        <div class="form-group" style="display: none">
                                            <label for="exampleInputEmail1">是否在新页面打开</label>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio"  id="oldpages" name="isnewpage"  class="iradio_flat-green" value="0" <?php if(($navigation["is_new_page"]) == "0"): ?>checked="checked"<?php endif; ?>>否
                                                </label>
                                                <label>
                                                    <input type="radio"  id="newpages" name="isnewpage" class="flat-red" value="1" <?php if(($navigation["is_new_page"]) == "1"): ?>checked="checked"<?php endif; ?>>是
                                                </label>
                                            </div>

                                        </div>

                                        <!--是否显示-->
                                        <div class="form-group" style="display: none">
                                            <div class="form-group">
                                                <label for="exampleInputEmail1">&nbsp;&nbsp;是否显示</label>
                                            </div>
                                            <div class="radio">
                                                <label>
                                                    <input type="radio" name="ishidden" class="iradio_flat-green" value="0" <?php if(($navigation["is_hidden"]) == "0"): ?>checked<?php endif; ?>>是
                                                </label>
                                                <label>
                                                    <input type="radio" name="ishidden" class="flat-red" value="1" <?php if(($navigation["is_hidden"]) == "1"): ?>checked<?php endif; ?>>否
                                                </label>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.form-group -->
                                    <!-- /.box-body -->
                                <div class="box-footer">
                                    <input type="hidden"  name="navid" value="<?php echo ($navigation["nav_id"]); ?>">
                                    <button type="submit" class="btn btn-primary">提交</button>
                                </div>
                                <!-- /.box -->
                            <!--</section>-->
                        </div>
                        <!-- end基本配置 -->

                        <!-- start seo信息-->
                        <div class="tab-pane" id="seoInfor" style="display: none">
                                <div class="box-body">
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">标题</label>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">关键字</label>
                                        <input type="text"  name="navkeywords" class="form-control" value="<?php echo ($navigation["nav_keywords"]); ?>">
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleInputEmail1">描述</label>
                                        <input type="text" name="navdescription" class="form-control" value="<?php echo ($navigation["nav_description"]); ?>">
                                    </div>
                                    <div class="box-footer">
                                        <input type="hidden"  name="navid" value="<?php echo ($navigation["nav_id"]); ?>">
                                        <button type="submit" class="btn btn-primary" id="sub">提交</button>
                                    </div>
                                </div> <!-- end seo信息-->
                            <!-- /#ion-icons -->
                            </div>
                      <!-- end seo信息-->
                </form>
                        <!-- /.tab-content -->
                    </div>
                    <!-- /.tab-content -->
                </div>
                <!-- /.nav-tabs-custom -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>

    <!-- Main content -->

    <!-- /.content -->
</div>
<!-- /.content-wrapper -->

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
<style type="text/css">

    .table > thead > tr > th, .table > tbody > tr > th, .table > tfoot > tr > th, .table > thead > tr > td, .table > tbody > tr > td, .table > tfoot > tr > td {
        border-top: 0 solid #f4f4f4;
    }

</style>
<div class="modal modal fade" id="myModal" tabindex="-1" role="dialog"
     aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header btn-primary" style="padding-top: 8px ;padding-bottom: 8px">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">URL列表</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="box-body" style="overflow-y: scroll; height: 300px" >
                        <input type='hidden' id='current_page'/>
                        <input type='hidden' id='show_per_page'/>
                        <table class="table" id="userlist">
                            <tbody >

                            </tbody>
                        </table>
                        <div>               
                            <div class="col-sm-5"><div aria-live="polite" role="status" id="usercout" class="dataTables_info"></div></div><div class="col-sm-7"><div class="dataTables_paginate paging_simple_numbers"><ul class="pagination" id="userpage"></ul></div></div>
                        </div>
                        <div>               
                        </div>
                        <!-- /.box-body -->
                    </div>
                </div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<script>
    //调用url
        $.ajax({
            url: "<?php echo U('Navigation/geturl');?>",
            type: "get",
            dataType: "json",
            async: "false",
            success: function (userdata) {
                if (userdata .status) {
                    $('#userlist tbody').html(userdata.content);
                }
            }
        });

    function selectuser(item) {
        var urlid = "#username_" + item;
        var usernameval = $(usernameid).html();

        $('#userinfoname').val(usernameval);
        $('#myModal').modal('hide');
    }

</script>
<script>
    function urllist(obj){
   var a= $(obj).parent('td').next('td').html();
        var b=$(obj).parent('td').prev('td').html();
        var c=  b.replace("&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;","");
    $('#innerurl').val(a);
        $('#innername').val(c);
        $('#myModal').modal('hide');
    }
</script>
<script>

    $('#out').change(function(){
        $('#isinner').hide();
        $('#isout').attr('name','navigationurl');
        $('#oldpages').prop('checked',false);
        $('#newpages').prop('checked',true);
        $('#oldpages').attr('checked',false);
        $('#newpages').attr('checked',true);
        $('#isinner').attr('name','nav');
        $('#isout').show();
    });

    $('#inner').change(function(){
        $('#isinner').show();
        $('#isout').attr('name','nav');
        $('#isinner').attr('name','navigationurl');
        $('#oldpages').prop('checked',true);
        $('#newpages').prop('checked',false);
        $('#oldpages').attr('checked',true);
        $('#newpages').attr('checked',false);
        $('#isout').hide();

    });


</script>