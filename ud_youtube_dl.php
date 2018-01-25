<?php
$isactive=file_get_contents("/var/www/html/omx_status");
	if ($isactive == "0"){
		echo shell_exec("bash /var/www/html/ud_youtube_dl.sh  >/dev/null 2>/dev/null &");
	}
?>