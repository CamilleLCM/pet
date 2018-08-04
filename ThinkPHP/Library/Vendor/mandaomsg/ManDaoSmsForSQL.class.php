<?php
/**
 * 用途：发送短信
 * 作者:sunyuhai
 * 日期:2013-08-15
 */
define("IN_D", 1);

class ManDaoSms{
	/**
	 * 立即发送短信
	 * @param  $mobile
	 * @param  $content
	 */
	function sendSMSMsg($mobile,$content,$dsql){
		return $this->sendSMSForMt($mobile,$content,$dsql);
	}
	function sendSMSForMt($mobile,$content,$dsql){
		$flag = 0;
		//要post的数据
		$argv = array(
				'sn'=>'SDK-BBX-010-20561', //提供的账号
				'pwd'=>strtoupper(md5('SDK-BBX-010-20561'.'D5-9223-')), //此处密码需要加密 加密方式为 md5(sn+password) 32位大写
				'mobile'=>$mobile,//手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号
				'content'=>iconv( "UTF-8", "gb2312//IGNORE" ,$content),//短信内容
				'ext'=>'',
				'stime'=>'',//定时时间 格式为2011-6-29 11:09:21
				'rrid'=>''
		);
		//构造要post的字符串
		foreach ($argv as $key=>$value) {
			if ($flag!=0) {
				$params .= "&";
				$flag = 1;
			}
			$params.= $key."="; $params.= urlencode($value);
			$flag = 1;
		}
		$length = strlen($params);
		//创建socket连接
		$fp = fsockopen("sdk.entinfo.cn",8060,$errno,$errstr,10) or exit($errstr."--->".$errno);
		//构造post请求的头
		$header = "POST /webservice.asmx/mt HTTP/1.1\r\n";
		$header .= "Host:sdk.entinfo.cn\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: ".$length."\r\n";
		$header .= "Connection: Close\r\n\r\n";
		//添加post的字符串
		$header .= $params."\r\n";
		//发送post的数据
		fputs($fp,$header);
		$inheader = 1;
		while (!feof($fp)) {
			$line = fgets($fp,1024); //去除请求包的头只显示页面的返回数据
			if ($inheader && ($line == "\n" || $line == "\r\n")) {
				$inheader = 0;
			}
			if ($inheader == 0) {
				// echo $line;
			}
		}
		$returnXml=$line;
		//<string xmlns="http://tempuri.org/">-5</string>
		$line=str_replace("<string xmlns=\"http://tempuri.org/\">","",$line);
		$line=str_replace("</string>","",$line);
		$result=explode("-",$line);
		//require_once(DEDEINC."/member/config.php");
		$sql="INSERT INTO send_sms_his(`mobile`,`content`,`send_time`,`return_result`,`return_xml`) VALUES('$mobile','$content','".time()."','$line','$returnXml')";
		$dsql->ExecuteNoneQuery($sql);
		if(count($result)>1){
		  	return 1;
		}else{
		  	return $line;
		}
	}
	function sendSMSMsgtest($mobile,$content,$dsql){
	
		//该demo的功能是给不同的手机号发不同的内容,短信的内容里有英文的逗号，参考此demo
		$flag = 0;
		//$aa = iconv( "UTF-8","gb2312","");
		//要post的数据
		$argv = array(
				'sn'=>'SDK-BBX-010-20561', //提供的账号
				'pwd'=>strtoupper(md5('SDK-BBX-010-20561'.'D5-9223-')), //此处密码需要加密 加密方式为 md5(sn+password) 32位大写
				'mobile'=>$mobile,//手机号 多个用英文的逗号隔开 一次小于1000个手机号
				'content'=>urlencode(iconv( "UTF-8","gb2312",$content)),//多个内容分别urlencode编码然后逗号隔开
				'ext'=>'',//子号(可以空 ,可以是1个 可以是多个,多个的需要和内容和手机号一一对应)
				'stime'=>'',//定时时间 格式为2011-6-29 11:09:21
				'rrid'=>''
		);
		//构造要post的字符串
		foreach ($argv as $key=>$value) {
			if ($flag!=0) {
				$params .= "&";
				$flag = 1;
			}
			$params.= $key."="; $params.=urlencode($value);
			$flag = 1;
		}
	
		$length = strlen($params);
	
		//创建socket连接  sdk是主通道，出问题切换到sdk2(备用通道),需要改2个sdk为sdk2
		$fp = fsockopen("sdk.entinfo.cn",8060,$errno,$errstr,10) or exit($errstr."--->".$errno);
		//构造post请求的头
		$header = "POST /webservice.asmx/gxmt HTTP/1.1\r\n";
		$header .= "Host:sdk.entinfo.cn\r\n";
		$header .= "Content-Type: application/x-www-form-urlencoded\r\n";
		$header .= "Content-Length: ".$length."\r\n";
		$header .= "Connection: Close\r\n\r\n";
		//添加post的字符串
		$header .= $params."\r\n";
		//发送post的数据
		fputs($fp,$header);
		$inheader = 1;
		while (!feof($fp)) {
			$line = fgets($fp,1024); //去除请求包的头只显示页面的返回数据
			if ($inheader && ($line == "\n" || $line == "\r\n")) {
				$inheader = 0;
			}
			if ($inheader == 0) {
				// echo $line;
			}
		}
		$returnXml=$line;
		//<string xmlns="http://tempuri.org/">-5</string>
		$line=str_replace("<string xmlns=\"http://tempuri.org/\">","",$line);
		$line=str_replace("</string>","",$line);
		$result=explode("-",$line);
		$sql="INSERT INTO send_sms_his(`mobile`,`content`,`send_time`,`return_result`,`return_xml`) VALUES('$mobile','$content','".time()."','$line','$returnXml')";
		$dsql->ExecuteNoneQuery($sql);
		if(count($result)>1){
			return 1;
		}else{
			return $line;
		}
	}
}
?>