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

<link rel="stylesheet" href="Public/index/stylesheets/blog.css">
<style>
	.pagination li{
		width: 10px;
		float: left;
		margin-left: 25px;
	}

</style>
<script>
	function subForm()
	{
		$("#form1").submit();
	}
</script>


<section>
	<div class="mid_container">
		<div class="blog_main">
			<div class="blog_lft lft">

				<?php if(is_array($result)): $i = 0; $__LIST__ = $result;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="post_main lft">
						<div class="post lft">
							<h3><?php echo ($vo["title"]); ?></h3>
							<span class="common_bg lft"><?php echo (date("Y-m-d",$vo['ctime'])); ?></span>
						</div>
						<div class="post_cont lft">
							<img src="Public/Uploads/<?php echo ($vo["img"]); ?>" width="100%" alt=""></br>
							<h4>名称：</h4><?php echo ($vo['title']); ?><br><span><br><h4>宠物外形特征：</h4><?php echo ($vo['num']); ?></span>
							<br><span><br><h4>宠物饲养方法：</h4><?php echo ($vo['varieties']); ?></span>

							<?php echo htmlspecialchars_decode($vo['content']); ?>
						</div>
					</div><?php endforeach; endif; else: echo "" ;endif; ?>
				<div class="wrapper lft">
					<?php echo ($pagehtml); ?>
				</div>
			</div>
			<div class="blog_rgt rgt">
				<div class="rgt_box lft">
					<div class="search lft">
						<form method="post" id="form1" action="<?php echo U('Index/Pet/index');?>">
							<div class="searchtxt lft"><input type="text" id="title" name="title" value="<?php echo ($title); ?>" /></div>
							<div class="go lft"><a href="javascript:;" onclick="subForm();">Go</a></div>
						</form>
					</div>
				</div>

			</div><div class="clear"></div>
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