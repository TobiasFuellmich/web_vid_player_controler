<?php
$config=array();
if(!file_exists("config.txt")){
	$file = fopen("config.txt", "w");
	fwrite($file,"blackback:on\r\naudio:hdmi\r\nfps_lock:on\r\nscrollbar:off\r\nthreshold:0\r\ntimeout:10\r\nbufsizevid:40\r\nbufsizeaud:10\r\n");
	fclose($file);
}
global $config;
$file = fopen("config.txt", "r") or die("Unable to open file!");
while(!feof($file)) {
	$temp=explode(":",fgets($file));
	$temp[1]=str_replace("\n", "", $temp[1]); 
	$temp[1]=str_replace("\r", "", $temp[1]); 
	array_push($config,$temp);
}
fclose($file);
?>