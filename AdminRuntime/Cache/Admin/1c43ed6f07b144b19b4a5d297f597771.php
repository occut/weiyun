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

<link rel="stylesheet" type="text/css" href="<?php echo ($resource); ?>h-ui.admin/css/H-ui.admin.css" />
<style>
    #editor{
        height: 400px;
        width: 500px;
        margin: 15px;
    }
</style>
<!-- 实例化编辑器 -->
<script type="text/javascript" charset="utf-8" src="ueditor.config.js"></script>
<script type="text/javascript" charset="utf-8" src="ueditor.all.min.js"> </script>
<!--建议手动加在语言，避免在ie下有时因为加载语言失败导致编辑器加载失败-->
<!--这里加载的语言文件会覆盖你在配置项目里添加的语言类型，比如你在配置项目里配置的是英文，这里加载的中文，那最后就是中文-->
<script type="text/javascript" charset="utf-8" src="<?php echo ($resource); ?>lang/zh-cn/zh-cn.js"></script>
<script type="text/javascript" src="http://code.jquery.com/jquery-latest.js"></script>
<style type="text/css">
    div{
        width:100%;
    }
</style>
<script type="text/javascript">
    var ue = UE.getEditor('container');
</script>
<div>

</div>
<div class="layui-body" >

        <div class="content-wrapper" style = "margin-left:1px ;">
            <div style="float:left;width:300px;margin-left:30px;margin-top:30px;text-align: center;">
                <h3>已保存的文章</h3>
                <p style="color:red;">文本域中文字已锁定</p>
                <textarea name="" id="" style = "" cols="40" rows="15" disabled><?php echo ($value["text_content"]); ?></textarea>
            </div>
             <div  style="float:left;width:300px;margin-left:30px;margin-top:30px;text-align: center;" >
                 <form class="layui-form" method="post" action="<?php echo U('Upload/addContent');?>">
                     <div style="width:300px;">
                     </div>
                     <div class="layui-form-item" >
                         <!--<label class="layui-form-label">单选框</label>-->
                         <div class="layui-input-block" style="margin:0px;">
                             <h3>待提交的文章</h3>
                             <p style="color:red;">请勿修改文本域中的文字，谢谢合作</p>
                             <textarea name="textarea" id="textarea" style = "" cols="40" rows="15" placeholder="文字:参数
视频:参数"></textarea>
                         </div>
                     </div>
                     <div class="layui-form-item">
                         <div class="layui-input-block" style="margin:0px;">
                             <button class="layui-btn" lay-submit lay-filter="add" style="">提交文章</button>
                             <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                         </div>
                     </div>
                 </form>
             </div>

        <div style="float:left;width:300px;margin-left:30px;margin-top:30px;text-align: center;">
            <form class="layui-form" action="">
                <h3>添加文章内容</h3>
                <p style="color:red;">请在输入文字后点击相对应的按钮</p>
                <div class="layui-form-item">
                    <label class="layui-form-label"><a onclick="value()"	class="layui-btn layui-btn-small">添加文字</a></label>
                    <div class="layui-input-block">
                        <input type="text" id="text" name="title" required  lay-verify="required" placeholder="请输入文字" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <script>
                        function value(){
                            document.getElementById("textarea").value = '';
                            var text = document.getElementById("text").value;
                            text = "文字:"+text;
//                            if(text1 == '' ){
                                document.getElementById("textarea").value = text;
//                            }else{
//                                var text2 = text1+"\r\n"+text;
//                                document.getElementById("textarea").value = text2;
//                            }
                        }
                </script>
                <div class="layui-form-item">
                    <label class="layui-form-label"><a onclick="value1()" class="layui-btn layui-btn-small">添加图片</a></label>
                    <div class="layui-input-block">
                        <input type="text" id="text1" name="title" required  lay-verify="required" placeholder="添加图片文件名，例:2.jpg" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <script>
                    function value1(){
                        var text1 = document.getElementById("textarea").value;
                        var text = document.getElementById("text1").value;
                        text = "图片:"+text;
                        if(text1 == '' ){
                            document.getElementById("textarea").value = text;
                        }else{
                            var text2 = text1+"\r\n"+text;
                            document.getElementById("textarea").value = text2;
                        }
                    }
                </script>
                <div class="layui-form-item">
                    <label class="layui-form-label"><a onclick="value2()" class="layui-btn layui-btn-small">添加视频</a></label>
                    <div class="layui-input-block">
                        <input type="text" id="text2" name="title" required  lay-verify="required" placeholder="请输入添加的视频文件名,例:2.mp4" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <script>
                    function value2(){
                        var text1 = document.getElementById("textarea").value;
                        var text = document.getElementById("text2").value;
                        text = "视频:"+text;
                        if(text1 == '' ){
                            document.getElementById("textarea").value = text;
                        }else{
                            var text2 = text1+"\r\n"+text;
                            document.getElementById("textarea").value = text2;
                        }
                    }
                </script>
                <div class="layui-form-item">
                    <label class="layui-form-label"> <a onclick="value3()" class="layui-btn layui-btn-small">添加延时</a></label>
                    <div class="layui-input-block">
                        <input type="text" id="text3" name="title" required  lay-verify="required" placeholder="请输入时间，单位:ms,例:3000" autocomplete="off" class="layui-input">
                    </div>
                </div>
                <div class="layui-form-item">
                    <div class="layui-input-block">
                        <a class="layui-btn"  onclick="value4()">一键添加</a>
                        <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                    </div>
                </div>
                <script>
                    function value3(){
                        var text1 = document.getElementById("textarea").value;
                        var text = document.getElementById("text3").value;
                        text = "延时:"+text;
                        if(text1 == '' ){
                            document.getElementById("textarea").value = text;
                        }else{
                            var text2 = text1+"\r\n"+text;
                            document.getElementById("textarea").value = text2;
                        }
                    }
                    function value4(){
                        document.getElementById("textarea").value = '';
//                        var text1 = document.getElementById("textarea").value;
                        var text = document.getElementById("text").value;
                        var text1 = document.getElementById("text1").value;
                        var text2 = document.getElementById("text2").value;
                        var text3 = document.getElementById("text3").value;

//                        text = "延时:"+text;
//                        if(text1 == '' ){
//                            document.getElementById("textarea").value = text;
//                        }else{
                            var text4 = "文字:"+text+"\r\n"+"图片:"+text1+"\r\n"+"视频:"+text2+"\r\n"+"延时:"+text3;
                            document.getElementById("textarea").value = text4;
//                        }
                    }
                </script>
            </form>
        </div>
            <div style="clear:both;margin-left:60px;margin-top:30px;text-align: left;">注：提交文章后会清空上次保存文章，请不要随意更改</div>
    </div>

        <script type="text/javascript">
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
        <!--请在下方写此页面业务相关的脚本-->