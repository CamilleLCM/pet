<?php
    if(C('LAYOUT_ON')) {
        echo '{__NOLAYOUT__}';
    }
?>

<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0, minimum-scale=1.0, maximum-scale=1.0">
<meta name="apple-mobile-web-app-capable" content="yes">
<meta name="apple-mobile-web-app-status-bar-style" content="black"> 
<meta content="telephone=no" name="format-detection"> 
<title>跳转提示</title>
<style type="text/css">
*{ padding: 0; margin: 0; }
body{ background: #fff; font-family: '微软雅黑'; color: #333; font-size: 14px; }
.system-message{ padding: 24px 48px; }
.system-message h1{ font-size: 50px; font-weight: normal; line-height: 120px; margin-bottom: 12px; }
.system-message .jump{ padding-top: 10px}
.system-message .jump a{ color: #333;}
.system-message .success,.system-message .error{ line-height: 1.8em; font-size: 16px }
.system-message .detail{ font-size: 12px; line-height: 20px; margin-top: 12px; display:none}
.xubox_page{position:absolute;width:100%;}
</style>
<script type="text/javascript" src="__PUBLIC__/js/jquery.js"></script>
<script type="text/javascript" src="__PUBLIC__/js/layer/layer.min.js"></script>
</head>

<body>

<div id="msgdiv" style="display:none;width:100%;height:300px; overflow:auto; background-color:#eee;">
	<div class="system-message">
		<?php if(isset($message)) {?>
		<h1>:)</h1>
		<p class="success"><?php echo($message); ?></p>
		<?php }else{?>
		<h1>:(</h1>
		<p class="error"><?php echo($error); ?></p>
		<?php }?>
		<p class="detail"></p>
		<p class="jump">
		页面自动 <a id="href" href="<?php echo($jumpUrl); ?>">跳转</a> 等待时间： <b id="wait"><?php echo($waitSecond); ?></b>
		</p>
	</div>
</div>


<script type="text/javascript">
var msgLayer;
function showScopeDiv(){
	$("#msgdiv").show();
	msgLayer = $.layer({
	    type: 1,
	    title: "提示信息",
	    //area: ['auto', 'auto'],
		area: ['80%', 'auto'],
	    border: [2,0.3,'#1f325c'], //去掉默认边框
	    shade: [0.5,'#1f325c'], //去掉遮罩
	    closeBtn: [0,true], //去掉默认关闭按钮
	    //shift: 'top', //从左动画弹出
	    fix: false,
	    page: {
	        dom: '#msgdiv'
	    },
		success: function(layero){
            myTimer();
        }		
	});
}

showScopeDiv();

function myTimer(){
    var wait = document.getElementById('wait'),href = document.getElementById('href').href;
    var interval = setInterval(function(){
	var time = --wait.innerHTML;
		if(time <= 0) { 
			location.href = href;
			clearInterval(interval);
		};
    }, 1000);
}



/*
(function(){
var wait = document.getElementById('wait'),href = document.getElementById('href').href;
var interval = setInterval(function(){
	var time = --wait.innerHTML;
	if(time <= 0) {
		//location.href = href;
		clearInterval(interval);
	};
}, 1000);
})();
*/
</script>
</body>
</html>
