<?php
if(isset($_GET["contr"])){
	if ($_GET["contr"]=="quit"){
		echo shell_exec("timeout 3 /var/www/html/quit.sh");
	}
	if ($_GET["contr"]=="pause"){
		echo shell_exec("timeout 3 /var/www/html/pause.sh");
	}
	if ($_GET["contr"]=="faster"){
		echo shell_exec("timeout 3 /var/www/html/faster.sh");
	}
	if ($_GET["contr"]=="backwards"){
		echo shell_exec("timeout 3 /var/www/html/backwards.sh");
	}
	if ($_GET["contr"]=="louder"){
		echo shell_exec("timeout 3 /var/www/html/louder.sh");
	}
	if ($_GET["contr"]=="quieter"){
		echo shell_exec("timeout 3 /var/www/html/quieter.sh");
	}
	if ($_GET["contr"]=="10min_for"){
		echo shell_exec("timeout 3 /var/www/html/10min_for.sh");
	}
	if ($_GET["contr"]=="10min_back"){
		echo shell_exec("timeout 3 /var/www/html/10min_back.sh");
	}
	if ($_GET["contr"]=="30s_for"){
		echo shell_exec("timeout 3 /var/www/html/30s_for.sh");
	}
	if ($_GET["contr"]=="30s_back"){
		echo shell_exec("timeout 3 /var/www/html/30s_back.sh");
	}
}
?>