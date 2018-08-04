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
	function sendSMSMsg($mobile,$content){
		return $this->sendSMSForMt($mobile,$content);
	}
	function sendSMSForMt($mobile,$content){
		$flag = 0;
		//要post的数据
		$argv = array(
				'sn'=>'SDK-BBX-010-21300', //提供的账号
				'pwd'=>strtoupper(md5('SDK-BBX-010-21300'.'1468@7f1')), //此处密码需要加密 加密方式为 md5(sn+password) 32位大写
				'mobile'=>$mobile,//手机号 多个用英文的逗号隔开 post理论没有长度限制.推荐群发一次小于等于10000个手机号
				'content'=>iconv( "UTF-8", "gb2312//IGNORE" ,$content),//短信内容
				'ext'=>'',
				'stime'=>'',//定时时间 格式为2011-6-29 11:09:21
				'rrid'=>''
		);
		$params="";
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
		//echo "line=".$line."<br/>";
		$returnXml=$line;
		//<string xmlns="http://tempuri.org/">-5</string>
		$line=str_replace("<string xmlns=\"http://tempuri.org/\">","",$line);
		$line=str_replace("</string>","",$line);
		$result=explode("-",$line);
		return $result;
	}
}
?>