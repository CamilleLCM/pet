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
    <div class="mid_container">
        <div class="blog_main">
            <div class="blog_lft lft">
                <div class="post_main lft">
                    <div class="post lft">
                        <a href="<?php echo U("Index/Message/info",array('id'=>$result['id']));?>">
                        <h3><?php echo ($title); ?></h3>
                        </a>
                        <span class="common_bg lft"><?php echo (date("Y-m-d",$result['ctime'])); ?></span>
                        <span class="common_bg  lft">评论数：<?php echo ((isset($result["comment_num"]) && ($result["comment_num"] !== ""))?($result["comment_num"]):0); ?></span>
                    </div>
                    <div class="post_cont lft">
                        <img width="100%" src="Public/Uploads/<?php echo ($result['img']); ?>">
                        <?php echo htmlspecialchars_decode($result['content']); ?>
                    </div>

                    <div class="comments_main lft">
                        <span class="comments_hd"><?php echo ((isset($result["comment_num"]) && ($result["comment_num"] !== ""))?($result["comment_num"]):0); ?> 评论</span>

                        <?php if(is_array($comment)): $i = 0; $__LIST__ = $comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class="comments1 lft">
                            <div class="comments1_lft lft">
                                <img src="Public/Uploads/<?php echo ($vo["user"]["img"]); ?>" width="82" height="82" alt="" />
                            </div>
                            <div class="comments1_rgt lft">
                                <div class="date_hd">
                                    <span class="lft"><?php echo ($vo["user"]["name"]); ?><br />

                                        <span class="datelink"><?php echo (date("Y-m-d H:i:s",$vo['ctime'])); ?></span></span>
                                    <span class="rgt"><a href="#" class="replylnk"></a></span><div class="clear"></div>
                                </div>
                                    <?php echo htmlspecialchars_decode($vo['content']); ?>
                            </div>
                        </div><?php endforeach; endif; else: echo "" ;endif; ?>


                    <div class="clear"></div>
                    </div>
                    <div class="contact_contlft lft">
                        <span class="leavecomments lft">请发出你的评论</span><div class="clear"></div>
                        <ul class="contact">
                            <form action="<?php echo U('Index/Message/comment');?>" method="post">
                            <li class="lft"><label>评论内容</label><br />
                                <textarea id="content" name="content" class="txtarea"></textarea></li>
                                <input type="hidden" name="id" value="<?php echo ($result["id"]); ?>">
                            <li class="last rgt"><input type="submit" value="留下你的脚印" class="submit_btn" /></li>
                            </form>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="blog_rgt rgt">
                <div class="rgt_box lft">
                    <div class="search lft">
                        <form method="post" id="form1" action="<?php echo U('Index/Message/index');?>">
                            <div class="searchtxt lft"><input type="text" id="title" name="title" value="<?php echo ($title); ?>" /></div>
                            <div class="go lft"><a href="javascript:;" onclick="subForm();">Go</a></div>
                        </form>
                    </div>
                </div>

                <div class="rgt_box abouttxt lft">
                    <h4>分类信息</h4>
                    <ul class="list">
                        <?php if(is_array($g_category)): $i = 0; $__LIST__ = $g_category;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li >
                                <h4>
                                    <a href="<?php echo U('Index/Message/index',array('category_id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?>
                                    </a>
                                </h4>
                            </li><?php endforeach; endif; else: echo "" ;endif; ?>


                    </ul>
                </div>
                <div class="rgt_box abouttxt lft">
                    <h4>评论最多的趣事</h4>
                    <ul class="list">
                        <?php if(is_array($message_coment)): $i = 0; $__LIST__ = $message_coment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><li><a href="<?php echo U("Index/Message/info",array('id'=>$vo['id']));?>"><?php echo ($vo["title"]); ?></a>
                                <span>(<?php echo ($vo["comment_num"]); ?>)</span></li><?php endforeach; endif; else: echo "" ;endif; ?>

                    </ul>
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