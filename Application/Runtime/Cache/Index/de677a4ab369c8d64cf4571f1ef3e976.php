<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html>
<head>
    <title>爱心宠物网站</title>
    <meta charset="utf-8">
    <link type="text/css" rel="stylesheet" href="Public/index/css/style.css" />
    <link href="Public/index/css/thickbox.css" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="Public/index/scripts/jquery.js"></script>
    <script type="text/javascript" src="Public/index/scripts/thickbox.js"></script>
    <script type="text/javascript" src="Public/index/scripts/scripts.js"></script>
</head>
<body>
<header>
    <div class="header_main">
        <div class="logo lft">
            <figure><img src="Public/index/images/logo_text.png" width="213" height="105" alt="Grab Tasty &amp; Quality" title="Grab Tasty &amp; Quality" /></figure>
        </div>
        <div class="header_rgt rgt">
            <div class="makereservation rgt"><h5><a href="<?php echo U("Index/Index/index");?>">爱心<br />宠物网站</a></h5></div>
            <nav>
                <ul id="navmenu-h">
                    <li><a href="<?php echo U("Index/Index/index");?>">首页</a>
                    </li>
                    <li><a href="<?php echo U("Index/Guanyu/index");?>">关于我们</a>
                        <ul>
                            <li><a href="<?php echo U("Index/Guanyu/index");?>">关于我们</a></li>
                            <li><a href="<?php echo U("Index/Yijian/index");?>">意见建议</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="<?php echo U("Index/Department/index");?>">萌宠认领</a>

                    </li>
                    <li><a href="<?php echo U("Index/Pet/index");?>">萌宠课堂</a>
                    </li>
                    <li><a href="<?php echo U("Index/Message/index");?>">趣事和知道</a>

                        <ul>
                            <?php if(is_array($g_category)): $i = 0; $__LIST__ = $g_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li>
                                    <a href="<?php echo U('Index/Message/index',array('category_id'=>$vo['id']));?>">
                                        <?php echo ($vo["title"]); ?>
                                    </a>
                                </li><?php endforeach; endif; else: echo "" ;endif; ?>
                        </ul>
                    </li>

                    <li><a href="<?php echo U("Index/Authority/index");?>">个人中心</a></li>
                </ul>
            </nav>
        </div><div class="clear"></div>
    </div>
</header>

<script>

    function change(){
        var date = new Date();
        var time = date.getTime();
        var url = "<?php echo U('Admin/Authority/getAuthcode');?>";
        url += "&t="+time;

        $('#verifyimg').attr('src',url);
    }

</script>

<section>
    <div class="mid_container">
        <div class="blog_main">
            <div class="blog_lft lft">
                <div class="post_main lft">

                    <div class="contact_contlft lft">
                        <span class="leavecomments lft"><a href="<?php echo U('Index/Authority/index');?>">登陆</a>|
                            <a href="<?php echo U('Index/Authority/zhuce');?>">注册</a></span><div class="clear"></div>
                        <ul class="contact">
                            <form id="subform" action="<?php echo U('Index/Authority/doZhuce');?>" method="post" enctype="multipart/form-data" >
                                <li class="lft"><label>用户名：</label><br />
                                    <input type="text" id="name" name="name" class="con_txtbx" /></li>
                                <div class="clear"></div>
                                <li class="lft"><label>头像：</label><br />
                                    <input type="file" id="img" name="img" class="con_txtbx" /></li>
                                <div class="clear"></div>

                                <li class="lft"><label>密码：</label><br />
                                    <input type="password" id="pwd" name="pwd" class="con_txtbx" /></li>
                                <div class="clear"></div>

                                <li class="lft"><label>用户真实姓名：</label><br />
                                    <input type="text" id="realname" name="realname" class="con_txtbx" /></li>
                                <div class="clear"></div>

                                <li class="lft"><label>手机号：</label><br />
                                    <input type="text" id="mobile" name="mobile" class="con_txtbx" /></li>
                                <div class="clear"></div>

                                <li class="lft"><label>邮箱：</label><br />
                                    <input type="text" id="email" name="email" class="con_txtbx" /></li>
                                <div class="clear"></div>

                                <li class="lft"><label>验证码：</label><br />
                                    <input type="text" class="con_txtbx" name="verify" id="verify">
                                    </li><br><br>
                                <a href="javascript:void(0);" onclick="change()" style="">
                                    <img src="<?php echo U('Index/Authority/getAuthcode');?>" id="verifyimg" alt="换一张" style="width:130px; height:40px;" /></a>
                                <div class="clear"></div>
                            <li class="last lft"><input type="submit" value="注册" class="submit_btn" /></li>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
           <div class="clear"></div>
        </div>
        <div class="top_btn rgt"><a class="backtop" href="#">Back to Top</a></div><div class="clear"></div>
    </div>
</section>




<div class="wrapper copyright_main">
    <div class="copyright"> </div>
</div>
<script type="text/javascript">
    if (!window.slider) var slider = {};
    slider.data = [
            <?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?>{
        "id": "slide-img-<?php echo ($vo["id"]); ?>",
        "client": "nature beauty",
        "desc": "nature beauty photography"
    },<?php endforeach; endif; else: echo "" ;endif; ?>
     ];
</script>

</body>
</html>