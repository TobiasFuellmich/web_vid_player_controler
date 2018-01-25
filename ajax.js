var in_request=false;
var xhttp;
var data="";
var instatus=false;
var after_status_file="";
var after_status_command="";
if (window.XMLHttpRequest) {
    xhttp = new XMLHttpRequest();
    } else {
    //for IE6, IE5
    xhttp = new ActiveXObject("Microsoft.XMLHTTP");
}
xhttp.onreadystatechange = function() {
	if (xhttp.readyState == 4 && xhttp.status == 200) {
		if (!instatus){
			data=xhttp.responseText;
		}else{
			var status=xhttp.responseText;
			var status_msg="In Bearbeitung...";
			switch(status){
				case "0":
				status_msg="Befehle werden erwartet.";
				break;
				case "1":
				status_msg="Video wird geladen...";
				break;
				case "2":
				status_msg="Streamcloud Link wird gesucht...";
				break;
				case "3":
				status_msg="Youtube Link wird gesucht...";
				break;
				case "4":
				status_msg="Videoplayer wird gestartet...";
				break;
				case "5":
				status_msg="Video wird abgespielt.";
				break;
				case "6":
				status_msg="Fehler: Das Video ist nicht so lang, andere Startzeit erforderlich.";
				break;
				case "7":
				status_msg="Youtube-dl wird aktualisiert";
				break;
				case "8":
				status_msg="Fehler: Das ist kein akzeptabler Youtube/Streamcloud Link.";
				break;
			}
			document.getElementById("feed").innerHTML=status_msg;
		}
		
	}
	if (xhttp.readyState == 4) {
		if (!instatus){
			after_status_file="";
			in_request=false;
		}else{
			instatus=false;
			in_request=false;
			if (after_status_file != ""){
				send_req(after_status_file,after_status_command);
			}
		}
	}
};
xhttp.ontimeout=function(){
	if (!instatus){
		alert("Raspberry reagiert nicht, haben sie ein Video gestartet ? oder ist eine Internet Verbindung nötig ?");
	}else{
		instatus=false;
	}
	in_request=false;
};
function getstatus(){
	instatus=true;
	if(!send_req("omx_status","a=")){
		instatus=false;
	};
}
status_interval = setInterval(getstatus, 1000);
function send_req(file,command){
	if(!in_request){
		in_request=true;
		var rand=Math.round(100000*Math.random());
		xhttp.open("GET", file+"?"+command+"&rand="+rand, true);
		xhttp.timeout=2000;
		xhttp.send();
		return true;
	}else{
		if(instatus){
			after_status_file=file;
			after_status_command=command;
		}
		return false;
	}
}
