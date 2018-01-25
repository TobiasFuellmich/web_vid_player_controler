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
function setup(){
	document.getElementById("vid_cont").scrollTo(0, top);
	document.getElementById('link_input').onkeypress = function(e){
	if (!e) e = window.event;
		var keyCode = e.keyCode || e.which;
		if (keyCode == '13'){
			changed_req();
		}
	}
}
function repall(str,search, replacement) {
    return str.replace(new RegExp(search, 'g'), replacement);
}
function changed_req(){
	var link =document.getElementById('link_input').value;
	if (link == ''){
		alert('Fehler : bitte gib einen Link ein um ein Video zu starten.');
	}else{
		if(((link.search("http://") != 0) || (link.length <= 7)) && ((link.search("https://") != 0) || (link.length <= 8))){
			alert('Fehler : ein Link muss mit "http://" oder "https://" beginnen und dahinter mindestens ein Zeichen haben.');
		}else{
			var timeh=parseInt(document.getElementById('timeh').value);
			var timem=parseInt(document.getElementById('timem').value);
			var times=parseInt(document.getElementById('times').value);
			times+=timeh*3600+timem*60;
			document.getElementById('link_input').value="";
			link=repall(link,"&", "{");
			send_req("omx_online.php","time="+times+"&link="+link);
		}
	}
}
</script>
</head>
<body onload='setup();'>
<div id="contain">
<div id='body_div'>
<div class='eintrag' style='position:absolute;left:100px;'>Stream (Youtube/Streamcloud/rohe MP4)</div>
<form method='get' action='' class='oeffnen_form' onsubmit="return false;">
<div class='eintrag' style='margin-top:28px;'><div class='name' style='width:95px;'>Link: </div>
<div style='width:740px;' class='order'>
	<input id="link_input" type="text" name="link">
	<span>bei :</span>
	<input type="number" id="timeh" class='new_button' style='width:40px;' min="0" max="99" value="0">
	<span>:</span>
	<input type="number" id="timem" class='new_button' style='width:40px;' min="0" max="59" value="0">
	<span>:</span>
	<input type="number" id="times" class='new_button' style='width:40px;' min="0" max="59" value="0">
	<div class='new_button' onclick='changed_req();'>starten</div>
</div>
</div>
</form>
<style type="text/css">
#movie_stripe{
	width:774px;
	height:135px;
	background:#555555;
	padding:3px;
	padding-top:5px;
	padding-bottom:5px;
	margin-bottom:10px;
}
#dots{
	width:774px;
	height:115px;
	border:dotted #eeeeee;
	border-width: 5px 0px 5px 0px;
	padding-top:5px;
	padding-bottom:5px;
}
.movie_stripe_pics{
	width:150px;
	height:115px;
	margin-right:6px;
	float:left;
	background:#eeeeee;
}
</style>
<div class='eintrag'>
<div id="movie_stripe">
<div id="dots">
<div class="movie_stripe_pics" style="background:url('yt_b1.png') no-repeat;"></div>
<div class="movie_stripe_pics" style="background:url('yt_b2.png') no-repeat;"></div>
<div class="movie_stripe_pics" style="background:url('yt_b3.png') no-repeat;"></div>
<div class="movie_stripe_pics" style="background:url('b4.png') no-repeat;"></div>
<div class="movie_stripe_pics" style="margin-right:0px;background:url('b5.png') no-repeat;"></div>
</div>
</div>
</div>
<div class='eintrag'>
<div id="movie_stripe">
<div id="dots">
<div class="movie_stripe_pics" style="background:url('sc_b1.png') no-repeat;"></div>
<div class="movie_stripe_pics" style="background:url('sc_b2.png') no-repeat;"></div>
<div class="movie_stripe_pics" style="background:url('sc_b3.png') no-repeat;"></div>
<div class="movie_stripe_pics" style="background:url('b4.png') no-repeat;"></div>
<div class="movie_stripe_pics" style="margin-right:0px;background:url('b5.png') no-repeat;"></div>
</div>
</div>
</div>
<div class='eintrag'>
<div id="movie_stripe">
<div id="dots">
<div class="movie_stripe_pics" style="background:url('raw_b1.png') no-repeat;"></div>
<div class="movie_stripe_pics" style="background:url('raw_b2.png') no-repeat;"></div>
<div class="movie_stripe_pics" style="background:url('raw_b3.png') no-repeat;"></div>
<div class="movie_stripe_pics" style="background:url('b4.png') no-repeat;"></div>
<div class="movie_stripe_pics" style="margin-right:0px;background:url('b5.png') no-repeat;"></div>
</div>
</div>
</div>
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
