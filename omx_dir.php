<?php
include 'getconfig.inc';//gets config in $config[]
if (isset($_GET["path"])){
	$isactive=file_get_contents("/var/www/html/omx_status");
	if ($isactive == "0"){
		$_GET["path"]=str_replace("{", "&", $_GET["path"]);
		$_GET["file"]=str_replace("{", "&", $_GET["file"]);
		$str1="'-g' ";$str3="0";
		if($config[0][1]=="on"){
			$str1="'-b' ";
		}
		if($config[2][1]=="on"){
			$str3="30";
		}
		echo shell_exec("bash /var/www/html/play.sh ".$str1."'".$config[1][1]."' '".$_GET["time"]."' '".$str3."' '".$_GET["path"]."' '".$_GET["file"]."' '".$config[4][1]."' '".$config[5][1]."' '".$config[6][1]."' '".$config[7][1]."' '".$_GET["for"]."' '".$_GET["chronik_line_nr"]."' '".$_GET["max_time"]."' >/dev/null 2>/dev/null &");
	}
}
?>