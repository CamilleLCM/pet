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

<section>
    <div class="slider_container">
        <div class="slider">
            <div id="slide-holder">
                <div id="slide-runner">

                    <?php if(is_array($banner)): $i = 0; $__LIST__ = $banner;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="lft"><a href="#">
                        <img id="slide-img-<?php echo ($vo['id']); ?>" src="Public/Uploads/<?php echo ($vo['img']); ?>" width="980" height="420" class="slide" alt="" />
                    </a></div><?php endforeach; endif; else: echo "" ;endif; ?>
                </div>
                <div id="slide-controls"><p id="slide-nav"></p></div>
            </div>
        </div>
    </div>
    <div class="wrapper">
        <div class="grab_details">
            <div class="grab_details_ins">
                <h2 class="txt-cnt">爱心宠物网站</h2>
                <ul class="dts lft">

                </ul>
                <ul class="dts lft">
                    <li><span>萌宠课堂</span></li>
                    <?php if(is_array($pet)): $i = 0; $__LIST__ = $pet;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/Pet/index',array('id'=>$vo['id']));?>">
                            <?php echo ($vo["title"]); ?>
                        </a></li><?php endforeach; endif; else: echo "" ;endif; ?>

                </ul>
                <ul class="dts lft">
                    <li><span>趣事和知道</span></li>
                    <?php if(is_array($message)): $i = 0; $__LIST__ = $message;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/message/info',array('id'=>$vo['id']));?>">
                            <?php echo ($vo["title"]); ?>
                        </a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <ul class="dts lft last">
                    <li><span>萌宠认领</span></li>
                    <?php if(is_array($department)): $i = 0; $__LIST__ = $department;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U('Index/Department/index',array('id'=>$vo['id']));?>">
                        <?php echo ($vo["title"]); ?>
                    </a></li><?php endforeach; endif; else: echo "" ;endif; ?>
                </ul>
                <div class="clear"></div>
            </div>
        </div>
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