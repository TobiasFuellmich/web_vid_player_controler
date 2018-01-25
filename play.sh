#bash /var/www/html/play.sh 
#1="-b(black background) or -s"
#2="hdmi/local"
#3="start time in s"
#4="fps"
#5="path to file/link"
#6="title"
#7=threshold
#8=timeout
#9=vid buffer in MB
#10=audio buffer in MB
#11="chronik(to save it complete) or anything else (to change it)"
#12="number in chronik (if not title)"
#13=max time of vid in secondes
echo -n "1" > /var/www/html/omx_status
bash /var/www/html/follow_omx.sh "$1" "$2" "$3" "$4" "$5" "$6" "$7" "$8" "$9" "${10}" "${11}" "${12}" "${13}"