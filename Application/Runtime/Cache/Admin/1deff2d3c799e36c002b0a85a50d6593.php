<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title> 爱心宠物网后台</title>
    <meta content="IE=edge,chrome=1" http-equiv="X-UA-Compatible">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">

    <link rel="stylesheet" type="text/css" href="Public/lib/bootstrap/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="Public/lib/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="Public/stylesheets/theme.css">
    <link rel="stylesheet" href="Public/lib/font-awesome/css/font-awesome.css">

    <script src="Public/lib/jquery-1.8.1.min.js" type="text/javascript"></script>
	<script type="text/javascript" src="Public/lib/jqplot/jquery.jqplot.min.js"></script>
	<script type="text/javascript" charset="utf-8" src="Public/javascripts/graphDemo.js"></script>
	<script src="Public/lib/bootstrap/js/bootstrap.js"></script>
    <!-- Demo page code -->
    
    <style type="text/css">
        #line-chart {
            height:300px;
            width:800px;
            margin: 0px auto;
            margin-top: 1em;
        }
        .brand { font-family: georgia, serif; }
        .brand .first {
            color: #ccc;
            font-style: italic;
        }
        .brand .second {
            color: #fff;
            font-weight: bold;
        }
    </style>

    <!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
    <!--[if lt IE 9]>
      <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

    <!-- Le fav and touch icons -->
    <link rel="shortcut icon" href="../assets/ico/favicon.ico">
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
    <link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
  </head>

  <!--[if lt IE 7 ]> <body class="ie ie6"> <![endif]-->
  <!--[if IE 7 ]> <body class="ie ie7"> <![endif]-->
  <!--[if IE 8 ]> <body class="ie ie8"> <![endif]-->
  <!--[if IE 9 ]> <body class="ie ie9"> <![endif]-->
  <!--[if (gt IE 9)|!(IE)]><!--> 
  <body> 
  <!--<![endif]-->
    
    <div class="navbar">
        <div class="navbar-inner">
            <div class="container-fluid">
                <ul class="nav pull-right">
                    
                    <li id="fat-menu" class="dropdown">
                        <a href="#" id="drop3" role="button" class="dropdown-toggle" data-toggle="dropdown">
                            <i class="icon-user"></i> <?php echo ($_SESSION['current_user']['name']); ?>
                            <i class="icon-caret-down"></i>
                        </a>

                        <ul class="dropdown-menu">
                            <li class="divider"></li>
                            <li><a tabindex="-1" href="<?php echo U('Admin/Authority/logout');?>" onclick="if (!confirm('确认退出吗？')) {return false;}">退出</a></li>
                        </ul>
                    </li>
                   
                </ul>
                <a class="brand" href="<?php echo U('Admin/Index/index');?>"><span class="first"></span> <span class="second">爱心宠物网站</span></a>
            </div>
        </div>
    </div>

<div class="container-fluid">

    <div class="row-fluid">
        <!-- left menu starts -->
<div class="span3">
                <div class="sidebar-nav">
                  <!--<div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu">
                      <i class="icon-dashboard"></i>管理员</div>
                    <ul id="dashboard-menu" class="nav nav-list collapse in">
                        <li><a href="<?php echo U('Admin/Veterinary/index');?>">管理员管理</a></li>
                        <li><a href="<?php echo U('Admin/Veterinary/add');?>">管理员添加</a></li>
                    </ul>-->
                <div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu">
                    <i class="icon-dashboard"></i>用户管理</div>
                <ul id="dashboard-menu" class="nav nav-list collapse in">
                    <li ><a href="<?php echo U('Admin/User/users');?>">用户管理</a></li>
                    <li ><a href="<?php echo U('Admin/User/add');?>">用户添加</a></li>
                </ul>

                    <div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu">
                        <i class="icon-dashboard"></i>宠物认领管理</div>
                    <ul id="dashboard-menu" class="nav nav-list collapse in">
                        <li><a href="<?php echo U('Admin/Department/index');?>">宠物认领列表</a></li>
                        <li><a href="<?php echo U('Admin/Department/add');?>">宠物认领添加</a></li>
                        <li><a href="<?php echo U('Admin/Department/examinelist');?>">宠物认领审核列表</a></li>
                    </ul>
                <div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu">
                  <i class="icon-dashboard"></i>宠物课堂管理</div>
                <ul id="dashboard-menu" class="nav nav-list collapse in">
                    <li><a href="<?php echo U('Admin/Pet/index');?>">宠物课堂列表</a></li>
                    <li><a href="<?php echo U('Admin/Pet/add');?>">宠物课堂添加</a></li>
                </ul>
                <!--<div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu">
                    <i class="icon-dashboard"></i>病例分享管理</div>
                <ul id="dashboard-menu" class="nav nav-list collapse in">
                    <li><a href="<?php echo U('Admin/Disease/index');?>">病例分享列表</a></li>
                    <li><a href="<?php echo U('Admin/Disease/add');?>">病例分享添加</a></li>
                </ul>-->
                    
                  <div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu">
                      <i class="icon-dashboard"></i>知道和趣事管理</div>
                    <ul id="dashboard-menu" class="nav nav-list collapse in">
                <!--        <li><a href="<?php echo U('Admin/Category/index');?>">类别</a></li>  -->
                        <li><a href="<?php echo U('Admin/Message/index');?>">知道和趣事列表</a></li>
                        <li><a href="<?php echo U('Admin/Message/add');?>">知道和趣事添加</a></li>
                        <li><a href="<?php echo U('Admin/Message/examinelist');?>">知道和趣事审核列表</a></li>
                    </ul>
                <div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu">
                    <i class="icon-dashboard"></i>评论意见管理</div>
                <ul id="dashboard-menu" class="nav nav-list collapse in">
                    <li><a href="<?php echo U('Admin/Comment/index');?>">评论列表</a></li>
                    <li><a href="<?php echo U('Admin/Yijian/index');?>">意见列表</a></li>
                </ul>
                <!--<div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu">
                    <i class="icon-dashboard"></i>静态网页</div>
                    <ul id="dashboard-menu" class="nav nav-list collapse in">
                        <li><a href="<?php echo U('Admin/Guanyu/index');?>">关于我们</a></li>
                    </ul>-->
                <div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu">
                    <i class="icon-dashboard"></i>图片管理</div>
                    <ul id="dashboard-menu" class="nav nav-list collapse in">
                        <li><a href="<?php echo U('Admin/Banner/index');?>">首页Banner管理</a></li>
                        <li><a href="<?php echo U('Admin/Banner/add');?>">首页Banner添加</a></li>
                    </ul>
               <!-- <div class="nav-header" data-toggle="collapse" data-target="#dashboard-menu">
                    <i class="icon-dashboard"></i>首页信息管理</div>
                <ul id="dashboard-menu" class="nav nav-list collapse in">
                    <li><a href="<?php echo U('Admin/Footter/index');?>">网页底部</a></li>
                </ul>-->

            </div>
        </div>
<!-- left menu ends -->
        <div class="span9">
            <h1 class="page-title">宠物认领审核列表</h1>
            <br><br>

            <div class="well">
                <table class="table">
                    <thead>
                    <tr>
                        <th>宠物照片</th>
                        <th>标题</th>
                        <th>添加时间</th>
                        <th>操作</th>
                    </tr>
                    </thead>
                    <tbody>
                    <?php if(is_array($result)): foreach($result as $key=>$vo): ?><tr>
                        <tr>
                            <td class="center">
                                <img alt="" width="80" src="Public/Uploads/<?php echo ($vo["img"]); ?>">
                            </td>
                            <td class="center"><?php echo ($vo['title']); ?></td>
                            <td class="center"><?php echo (date("Y-m-d H:i:s",$vo['ctime'])); ?></td>

                            <td>
                                &nbsp;&nbsp;<a href="<?php echo U('Admin/Department/examine',array('id'=>$vo['id']));?>"><i class="icon-pencil"></i></a>
                            </td>
                        </tr><?php endforeach; endif; ?>
                    </tbody>
                </table>
            </div>
            <?php echo ($pagehtml); ?>
            <div class="modal small hide fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                    <h3 id="myModalLabel">Delete Confirmation</h3>
                </div>
                <div class="modal-body">
                    <p class="error-text"><i class="icon-warning-sign modal-icon"></i>Are you sure you want to delete the user?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn" data-dismiss="modal" aria-hidden="true">Cancel</button>
                    <button class="btn btn-danger" data-dismiss="modal">Delete</button>
                </div>
            </div>

        </div>
    </div>

    <footer>
        <hr>
        <p>&copy; 2018 Online Media Organizor</a></p>
    </footer>

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="lib/bootstrap/js/bootstrap.js"></script>
    </body>
    </html>