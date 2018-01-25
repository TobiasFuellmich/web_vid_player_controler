<html>
<head>
<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
<link href="index.css" rel="stylesheet">
<script src="ajax.js"></script>
</head>
<body>
<div id="contain">
<div id='body_div'>
<div class='eintrag'>Einstellungen :</div>
<form method='get' action='' class='oeffnen_form'>
<?php 
if($_GET["rm_config"]=="true"){
	unlink("config.txt");
}
include 'getconfig.inc';//gets config in $config[]
if(isset($_GET["sub"])){
	if(isset($_GET["blackback"])){
		$config[0][1]="on";
	}else{
		$config[0][1]="off";
	}
	if(isset($_GET["audio"])){
		if($_GET["audio"]=="local"){
			$config[1][1]="local";
		}else{
			$config[1][1]="hdmi";
		}
	}
	if(isset($_GET["fps_lock"])){
		$config[2][1]="on";
	}else{
		$config[2][1]="off";
	}
	if(isset($_GET["scrollbar"])){
		$config[3][1]="on";
	}else{
		$config[3][1]="off";
	}
	if(isset($_GET["threshold"])){
		$config[4][1]=$_GET["threshold"];
	}
	if(isset($_GET["timeout"])){
		$config[5][1]=$_GET["timeout"];
	}
	if(isset($_GET["bufsizevid"])){
		$config[6][1]=$_GET["bufsizevid"];
	}
	if(isset($_GET["bufsizeaud"])){
		$config[7][1]=$_GET["bufsizeaud"];
	}
}
$towrite="";
for($i=0;$i<sizeof($config)-1;$i++) {
	$towrite.=$config[$i][0].":".$config[$i][1]."\r\n";
}
$file = fopen("config.txt", "w") or die("Unable to open file!");
fwrite($file,$towrite);
fclose($file);
echo "<div class='eintrag' style='margin-top:10px;'><div class='name' style='width:400px;'>Schwarzer Hintergrund einschalten</div><div class='order' style='width:350px;'><input type='checkbox' name='blackback' value='on'";
if(strcmp($config[0][1],"on")==0){echo " checked";}
echo "></div></div>
<div class='eintrag'><div class='name' style='width:400px;'>Ton Ausgabe</div><div class='order' style='width:350px;'>
	HDMI 
	<input type='radio' name='audio' value='hdmi'";
if(strcmp($config[1][1],"hdmi")==0){echo " checked";}
echo ">
	Analog 
	<input type='radio' name='audio' value='local'";
if(strcmp($config[1][1],"local")==0){echo " checked";}
echo ">
</div></div>
<div class='eintrag'><div class='name' style='width:400px;'>30 FPS Sperre einschalten</div><div class='order' style='width:350px;'><input type='checkbox' name='fps_lock' value='on'";
if(strcmp($config[2][1],"on")==0){echo " checked";}
echo "></div></div>
<div class='eintrag'><div class='name' style='width:400px;'>Fernbedienungs Scrollleiste einschalten</div><div class='order' style='width:350px;'><input type='checkbox' name='scrollbar' value='on'";
if(strcmp($config[3][1],"on")==0){echo " checked";}
echo "></div></div>
<div class='eintrag'><div class='name' style='width:400px;'>Bufferzeit bis Video startet</div><div class='order' style='width:350px;'>
<input type='number' name='threshold' class='new_button' style='width:80px;' min='0' max='3600' value='".$config[4][1]."'></div></div>
<div class='eintrag'><div class='name' style='width:400px;'>Zeit in sekunden bis ein Video abbricht</div><div class='order' style='width:350px;'>
<input type='number' name='timeout' class='new_button' style='width:80px;' min='0' max='3600' value='".$config[5][1]."'></div></div>
<div class='eintrag'><div class='name' style='width:400px;'>Video Buffergröße in MB</div><div class='order' style='width:350px;'>
<input type='number' name='bufsizevid' class='new_button' style='width:80px;' min='0' max='400' value='".$config[6][1]."'></div></div>
<div class='eintrag'><div class='name' style='width:400px;'>Audio Buffergröße in MB</div><div class='order' style='width:350px;'>
<input type='number' name='bufsizeaud' class='new_button' style='width:80px;' min='0' max='100' value='".$config[7][1]."'></div></div>";
?>
<button type='submit' style='margin-top:10px;width:120px;margin-left:413px;' name='sub' value='none' class='new_button'>&Uuml;bernehmen</button>
</form>
<div class='eintrag' style="border:solid #555555;border-width:2px 0px 0px 0px;top:0px;padding-top:10px;">
	<div class='name' style='width:400px;'>Youtube-dl aktualisieren</div>
	<div class='order' style='width:350px;'>
		<div class='new_button' onclick='send_req("ud_youtube_dl.php","none=");'>starten</div>
	</div>
</div>
<div class='eintrag' style="border:solid #555555;border-width:2px 0px 0px 0px;top:0px;padding-top:10px;">
	<div class='name' style='width:400px;'>Omxplayer zur&uuml;cksetzen</div>
	<div class='order' style='width:350px;'>
		<div class='new_button' onclick='send_req("reset_omx.php","none=");'>starten</div>
	</div>
</div>
<div class='eintrag' style="top:0px">
	<div class='name' style='width:400px;'>Einstellungen zurücksetzen</div>
	<div class='order' style='width:350px;'>
		<form method='get' action='' class='oeffnen_form'>
			<button type='submit' name='rm_config' value='true' class='new_button'>starten</button>
		</form>
	</div>
</div>
</div></div>
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


