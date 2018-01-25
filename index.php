<html>
<head>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<link href="index.css" rel="stylesheet">
<script src="ajax.js"></script>
<script type="text/javascript">
cont_isopened=false;
iscrollable=
<?php include 'getconfig.inc';//gets config in $config[]
if ($config[3][1]=="on"){echo "true";}else{echo "false";}?>;
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
function checkSize(max_img_size)
{
    var input = document.getElementById("file");        
	if (input.files[0].size > max_img_size){
		alert("The file must be less than " + (max_img_size/1024/1024) + "MB");
		return false;
	}
	return true;
}
function setfname(){
	var p=document.getElementById('file').value;
	if(p.indexOf('\\')>=0 || p.indexOf('/')>=0 ){
		var index=p.lastIndexOf('\\');
		if (index==-1){
			var index=p.lastIndexOf('/');
		}
		p=p.substring(index+1);
	}
	document.getElementById("fname").innerHTML=p;
}
function checkinput(){
	var name=document.getElementById('dir_name_input').value;
	if (name == '"Ordner Name"'){
		alert('Fehler : bitte gib einen Namen bei "Ordner Name" ein, um einen Ordner zu erstellen.');
		return false;
	}else{
		return true;
	}
}
function repall(str,search, replacement) {
    return str.replace(new RegExp(search, 'g'), replacement);
}
function changed_req(php_file_name,filename,path,other_data,num){
	filename=repall(filename,"&", "{");
	path=repall(path,"&", "{");
	var timeh=parseInt(document.getElementById('timeh'+num).value);
	var timem=parseInt(document.getElementById('timem'+num).value);
	var times=parseInt(document.getElementById('times'+num).value);
	times+=timeh*3600+timem*60;
	send_req(php_file_name,other_data+"&file="+filename+"&path="+path+"&time="+times);
}
</script>
</head>
<body onload='scroll_cont();'>
<div id="contain">
<div id='body_div'>
<?php
$path="/var/www/html/external/";
$short_path="external/";
$path_to_add="";
$path_to_add_array=explode("/", $_GET["ordner"]);
$last_act=$path_to_add_array[sizeof($path_to_add_array)-1];
if($last_act==""){
	$path.=$_GET["ordner"];
	$short_path.=$_GET["ordner"];
	$path_to_add=$_GET["ordner"];
}else{
	if ($last_act!=".."){
		$path.=$_GET["ordner"]."/";
		$short_path.=$_GET["ordner"]."/";
		$path_to_add=$_GET["ordner"]."/";
	}
}
$array_path=explode("/", $path);
if ((sizeof($path_to_add_array)>1) && ($last_act=="..")){
	array_pop($path_to_add_array);
	array_pop($path_to_add_array);
	if (sizeof($path_to_add_array)!=0){
		for($i=0;$i<sizeof($path_to_add_array);$i++){
			$path.=$path_to_add_array[$i]."/";
			$short_path.=$path_to_add_array[$i]."/";
			$path_to_add.=$path_to_add_array[$i]."/";
		}
	}
}
$space=20000000000;
if (isset($_POST['file'])){
$uploadfile = $path.basename($_FILES['userfile']['name']);
echo "<script>alert('";#del
if ($_FILES['userfile']['size']<=$space){
if (move_uploaded_file($_FILES['userfile']['tmp_name'], $uploadfile)) {
    echo "Datei ist valide und wurde erfolgreich hochgeladen.";
} else {
    echo "Fehler : Möglicherweise wurde keine Datei gewählt.";
}}else{
echo "Fehler : zu wenig Speicher.";
}
echo "');</script>";#del
}
if (isset($_POST['create_dir'])){
	$pos=$path.$_POST['dir_name'];
	if (mkdir($pos)!=True){
		echo "<script>alert('Fehler : existiert der Ordner schon ?');</script>";
	}
}
function rrmdir($dir) { 
	if (is_dir($dir)) { 
		$objects = scandir($dir); 
		foreach ($objects as $object) { 
			if ($object != "." && $object != "..") { 
				if (is_dir($dir."/".$object)){
					rrmdir($dir."/".$object);
				}else{
					unlink($dir."/".$object);
				}
			} 
		}
	rmdir($dir); 
	} 
}
if (isset($_POST['remove'])){
	$pos=$path.$_POST['rm_name'];
	if (is_dir($pos)){
		rrmdir($pos);
	}else{
		unlink($pos);
	}
}
$a = scandir($path);
echo "<div class='eintrag' style='position:absolute;left:100px;'>Pfad: ".$short_path."</div>
<div class='eintrag' style='margin-top:28px;height:25px;'>
<form enctype='multipart/form-data' action='' method='post' class='oeffnen_form'  onsubmit='return checkSize(".$space.")'>
	<input type='hidden' name='ordner' value='".$path_to_add."' />
	<input type='hidden' name='MAX_FILE_SIZE' value='".$space."' />
	<label><input onchange='setfname(2);' name='userfile' type='file' id='file' style='position:fixed;top:-1000px;'/>
    <div id='fname' class='new_button' style='margin-left:0px;width:273px;overflow:hidden;text-overflow:ellipsis;white-space:nowrap;'>Datei w&auml;hlen</div></label>
    <input type='submit' name='file' value='hochladen' class='new_button'/>
</form>
<form action='' method='post' class='oeffnen_form' onsubmit='return checkinput();'>
	<input type='hidden' name='ordner' value='".$path_to_add."' />
	<input id='dir_name_input' type='text' name='dir_name' style='width:168px;' value='".'"'."Ordner Name".'"'."'>
	<input type='submit' name='create_dir' value='mk Ordner' class='new_button'/>
</form>
</div>
<div class='eintrag'>
<div class='type'>Ordner:</div><div class='name'>..</div>
<div class='order'><form method='get' action='' class='oeffnen_form'><button type='submit' name='ordner' value='".$path_to_add."..' class='new_button'>&ouml;ffnen</button></form></div></div>";
for ($i=2;$i<sizeof($a);$i++){
	if (strpos($a[$i], ".mp4")!=False || strpos($a[$i], ".mp3")!=False){
		echo "<div class='eintrag'>
		<div class='type'>Spielbar:</div><div class='name'>".$a[$i]."</div>
		<div class='order'><a href='".$short_path.$a[$i]."' download><div class='new_button'>download</div></a>   <a href='".$short_path.$a[$i]."'><div class='new_button'>sehen</div></a>
		<form method='get' action='' class='oeffnen_form' onsubmit='return false;'>
		<span>bei :</span>
		<input type='number' id='timeh".$i."' class='new_button' style='width:40px;' min='0' max='99' value='0'>
		<span>:</span>
		<input type='number' id='timem".$i."' class='new_button' style='width:40px;' min='0' max='59' value='0'>
		<span>:</span>
		<input type='number' id='times".$i."' class='new_button' style='width:40px;' min='0' max='59' value='0'>
		</form>
		<div class='new_button' onclick='changed_req(".'"'."omx_dir.php".'"'.",".'"'.$a[$i].'"'.",".'"'.$path.$a[$i].'"'.",".'"'."for=chronik".'"'.",".'"'.$i.'"'.")'>starten</div>";
	}else{
		if(is_dir($path.$a[$i])!=False){
			echo "<div class='eintrag'>
			<div class='type'>Ordner:</div><div class='name'>".$a[$i]."</div>
			<div class='order'><form method='get' action='' class='oeffnen_form'><button type='submit' name='ordner' value='".$path_to_add.$a[$i]."' class='new_button'>&ouml;ffnen</button></form>";
		}else{
			echo "<div class='eintrag'>
			<div class='type'>Unbekannt:</div><div class='name'>".$a[$i]."</div>
			<div class='order'><a href='".$short_path.$a[$i]."' download><div class='new_button'>download</div></a>";
		}
	}
	echo "<form action='' method='post' class='oeffnen_form'>
	<input type='hidden' name='ordner' value='".$path_to_add."' />
	<input type='hidden' name='rm_name' value='".$a[$i]."' />
	<input type='submit' name='remove' value='l&ouml;schen' class='new_button'/>
	</form></div></div>";
} ?>
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
