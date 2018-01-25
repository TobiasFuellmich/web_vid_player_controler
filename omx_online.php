<?php
include 'getconfig.inc';//gets config in $config[]
if (isset($_GET["link"])){
	$isactive=file_get_contents("/var/www/html/omx_status");
	if ($isactive == "0"){
		$_GET["link"]=str_replace("{", "&", $_GET["link"]);
		$str1="'-g' ";$str3="0";
		if($config[0][1]=="on"){
			$str1="'-b' ";
		}
		if($config[2][1]=="on"){
			$str3="30";
		}
		if ((strpos($_GET["link"],"youtube.com")!=0 && strpos($_GET["link"],"youtube.com")!=False) ||
		(strpos($_GET["link"],"youtu.be")!=0 && strpos($_GET["link"],"youtu.be")!=False)){
			$real_link = explode("&",$_GET["link"]);
			echo shell_exec("bash /var/www/html/playyt.sh ".$str1."'".$config[1][1]."' '".$_GET["time"]."' '".$str3."' '".$real_link[0]."' '".$config[4][1]."' '".$config[5][1]."' '".$config[6][1]."' '".$config[7][1]."' >/dev/null 2>/dev/null &");
		}elseif(strpos($_GET["link"],"streamcloud.eu/")!=0 && strpos($_GET["link"],"streamcloud")!=False){
			echo shell_exec("bash /var/www/html/playsc.sh ".$str1."'".$config[1][1]."' '".$_GET["time"]."' '".$str3."' '".$_GET["link"]."' '".$config[4][1]."' '".$config[5][1]."' '".$config[6][1]."' '".$config[7][1]."' >/dev/null 2>/dev/null &");
		}else{
			echo shell_exec("bash /var/www/html/play.sh ".$str1."'".$config[1][1]."' '".$_GET["time"]."' '".$str3."' '".$_GET["link"]."' '".$_GET["link"]."' '".$config[4][1]."' '".$config[5][1]."' '".$config[6][1]."' '".$config[7][1]."' 'chronik' >/dev/null 2>/dev/null &");
		}
	}
}
?>