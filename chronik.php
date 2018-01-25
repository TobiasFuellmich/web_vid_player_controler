<html>
<head>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<link href="index.css" rel="stylesheet">
<script src="ajax.js"></script>
<script type="text/javascript">
cont_isopened=false;
iscrollable=false;
function open_cont(){
	if (!cont_isopened){
		document.getElementById("body_div").style.paddingLeft="100px";
		document.getElementById("vid_cont").style.height="100%";
		document.getElementById("vid_cont").style.marginLeft="-100px";
		if(iscrollable){
			document.getElementById("vid_cont").style.overflowY="scroll";
		}
		cont_isopened=true;
	}else{
		document.getElementById("body_div").style.paddingLeft="0px";
		document.getElementById("vid_cont").style.height="80px";
		document.getElementById("vid_cont").style.marginLeft="0px";
		if(iscrollable){
			document.getElementById("vid_cont").style.overflow="hidden";
		}
		cont_isopened=false;
	}
}
function scroll_cont(){
	document.getElementById("vid_cont").scrollTo(0, top);
}
function repall(str,search, replacement) {
    return str.replace(new RegExp(search, 'g'), replacement);
}
function changed_req(php_file_name,path,other_data,num){
	path=repall(path,"&", "{");
	var timeh=parseInt(document.getElementById('timeh'+num).value);
	var timem=parseInt(document.getElementById('timem'+num).value);
	var times=parseInt(document.getElementById('times'+num).value);
	times+=timeh*3600+timem*60;
	send_req(php_file_name,other_data+"&path="+path+"&time="+times);

}
</script>
</head>
<body onload='scroll_cont();'>
<div id="contain">
<div id='body_div'>
<div class='eintrag' style='position:absolute;left:100px;'>
<div class="order" style="width:509px">Chronik (Fehlerhafte Links/ Dateien werden gefiltert)</div>
<div class="name">
<form method='get' action='' class='oeffnen_form'>
<button type='submit' name='rm_chronik' value='true' class='new_button'>l&ouml;schen</button>
</form>
</div>
</div>
<?php
if($_GET["rm_chronik"]=="true"){
	unlink("chronik.txt");
}
if(file_exists("chronik.txt")){
$file = fopen("chronik.txt", "r") or die("Unable to open file!");
$fl=true;
$count =0;
while(!feof($file)) {
	$data=fgets($file);
	if (($data != " ") && ($data != "")){
	$data=str_replace("\n", "", $data); 
	$data=str_replace("\r", "", $data);
	$temp=explode("}:",$data);
	$time=explode(":",$temp[2]);
	echo "<div class='eintrag'";
	if ($fl){
		$fl=false;
		echo " style='margin-top:28px;' ";
	}
	echo "><div class='name' style='width:400px;'>".$temp[0]."</div><div style='width:300px;' class='order'>
	<form method='get' action='' class='oeffnen_form' onsubmit='return false;'>
	<span>bei :</span>
	<input type='number' id='timeh".$count."' class='new_button' style='width:40px;' min='0' max='99' value='".$time[0]."'>
	<span>:</span>
	<input type='number' id='timem".$count."' class='new_button' style='width:40px;' min='0' max='59' value='".$time[1]."'>
	<span>:</span>
	<input type='number' id='times".$count."' class='new_button' style='width:40px;' min='0' max='59' value='".$time[2]."'>
	</form>
	<div class='new_button' onclick='changed_req(".'"'."omx_dir.php".'"'.",".'"'.$temp[1].'"'.",".'"'."for=none&file=".$temp[0]."&chronik_line_nr=".($count+1)."&max_time=".$temp[3].'"'.",".'"'.$count.'"'.");'>starten</div>
	</div></div>";
	$count++;
	}
}
fclose($file);
}
?>
<div id='vid_cont'>
<div onclick='open_cont();' class='new_button cont_button' style='height:18px;margin-top:52px;font-size:12;'>\/\/\/</div>
<div style='margin-top:10px;' class='new_button cont_button' onclick='send_req("control_vid.php","contr=quit")'>X</div>
<div style='margin-top:10px;' class='new_button cont_button' onclick='send_req("control_vid.php","contr=10min_back");'>|<<</div>
<div style='margin-top:10px;' class='new_button cont_button' onclick='send_req("control_vid.php","contr=10min_for");'>>>|</div>
<div style='margin-top:10px;' class='new_button cont_button' onclick='send_req("control_vid.php","contr=30s_back");'>|<</div>
<div style='margin-top:10px;' class='new_button cont_button' onclick='send_req("control_vid.php","contr=30s_for");'>>|</div>
<div style='margin-top:10px;' class='new_button cont_button' onclick='send_req("control_vid.php","contr=pause");'>||</div>
<div style='margin-top:10px;' class='new_button cont_button' onclick='send_req("control_vid.php","contr=faster");'>>></div>
<div style='margin-top:10px;' class='new_button cont_button' onclick='send_req("control_vid.php","contr=backwards");'><<</div>
<div style='margin-top:10px;text-align:left;' class='new_button cont_button' onclick='send_req("control_vid.php","contr=louder");'>
<div class="sound_img"></div>+</div>
<div style='margin-top:10px;margin-bottom:25px;text-align:left;' class='new_button cont_button' onclick='send_req("control_vid.php","contr=quieter");'>
<div class="sound_img" style="padding-right:3px;"></div>-</div></div></div></div>
<div id="header">
<div id="header_row">
<a href='index.php'><div class='header_button'>Explorer</div></a>
<a href='stream.php'><div class='header_button'>Online Streaming</div></a>
<a href='chronik.php'><div class='header_button'>Chronik</div></a>
<a href='einstellungen.php'><div class='header_button'>Einstellungen</div></a>
</div>
</div>
<div id="feed"></div>
</body>
</html>
