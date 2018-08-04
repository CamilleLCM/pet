<?php
return array(
	//基本  		
	    'DEFAULT_MODULE' => 'Index', //默认模块		
		'SESSION_AUTO_START' => true, //是否开启session		
	//数据库		
		'DB_TYPE' => 'mysql', // 数据库类型
		'DB_HOST' => 'localhost', // 服务器地址
		'DB_NAME' => 'pet', // 数据库名
		'DB_USER' => 'root', // 用户名
		'DB_PWD' => 'root', // 密码
		'DB_PORT' => 3306, // 端口
		'DB_PREFIX' => 'as_', // 数据库表前缀
		'DB_FIELDS_CACHE' => true, // 启用字段缓存
		'DB_CHARSET' => 'utf8', // 数据库编码默认采用utf8
		'DB_DEPLOY_TYPE' => 0, // 数据库部署方式:0 集中式(单一服务器),1 分布式(主从服务器)
	//url
		'URL_CASE_INSENSITIVE' => true, // 默认false 表示URL区分大小写 true则表示不区分大小写
		'URL_MODEL' =>0, // URL访问模式,可选参数0、1、2、3,代表以下四种模式：
		// 0 (普通模式); 1 (PATHINFO 模式); 2 (REWRITE 模式); 3 (兼容模式) 默认为PATHINFO 模式
		'URL_PATHINFO_DEPR' => '/', // PATHINFO模式下，各参数之间的分割符号		
		'URL_HTML_SUFFIX' => 'html', // URL伪静态后缀设置
		'URL_DENY_SUFFIX' => 'ico|png|gif|jpg', // URL禁止访问的后缀设置
		'URL_PARAMS_BIND' => true, // URL变量绑定到Action方法参数		
		'URL_404_REDIRECT' => '', // 404 跳转页面 部署模式有效	

);