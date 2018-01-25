#bash /var/www/html/playyt.sh 
#1="-b(black background) or -s"
#2="hdmi/local"
#3="start time in s"
#4="fps"
#5="youtube link"
#6=threshold
#7=timeout
#8=vid buffer in MB
#9=audio buffer in MB
echo -n "3" > /var/www/html/omx_status
a=$(youtube-dl -g -e -f mp4 "$5")
if [[ $a != "" ]]
	then
		readarray -t lines < <(echo "$a")
		line1="${lines[1]}";line0="${lines[0]}"
	else
		echo -n "8" > /var/www/html/omx_status
		sleep 1.1
		echo -n "0" > /var/www/html/omx_status
		exit 0
	fi
bash /var/www/html/follow_omx.sh "$1" "$2" "$3" "$4" "$line1" "$line0" "$6" "$7" "$8" "$9" "chronik"