<?php


function strToHex($string){
	$hex="";
	for($i=0;$i<strlen($string);$i++)
		$hex.=dechex(ord($string[$i]));
		$hex=strtoupper($hex);
		return $hex;
}

function hexToStr($hex){
$string="";
	for ($i=0;$i<strlen($hex)-1;$i+=2)
		$string.=chr(hexdec($hex[$i].$hex[$i+1]));
		return $string;
}

