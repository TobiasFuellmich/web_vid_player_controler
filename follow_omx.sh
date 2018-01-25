echo -n "4" > /var/www/html/omx_status
omxplayer "$1" -g -o "$2" -l "$3" --fps "$4" --threshold "$7" --timeout "$8" --video_queue "$9" --audio_queue "${10}" "$5" < /var/www/html/fifo > /var/www/html/output &
echo -n "p" > /var/www/html/fifo
echo -n "p" > /var/www/html/fifo
if [[ ${11} == "chronik" ]]
	then
		time=$(mediainfo --Inform="Video;%Duration%" "$5")
		time=${time%???}
	else
		time=${13}
	fi
if [[ "$time" -lt "$3" ]]
	then
		echo -n "6" > /var/www/html/omx_status
		sleep 1.1
		echo -n "0" > /var/www/html/omx_status
		exit 0
	fi
echo -n "5" > /var/www/html/omx_status
while [[ $(pgrep omxplayer -n) != "" ]]
	do
		sleep 0.1
done
t=$(tail -2 "/var/www/html/output")
if [[ $t == "have a nice day ;)" ]]
	then
		echo -n "0" > /var/www/html/omx_status
		exit 0
	fi
proof=$(echo $t | head -c 12)
if [[ $proof != "Stopped at: " ]]
	then
		t=00:00:00
	else
		t=${t##*$"Stopped at: "};
		t=${t%%$"h"*};t=${t%?};
	fi
if [[ ${11} == "chronik" ]]
	then
		echo "$6"}:"$5"}:"$t"}:"$time" >> /var/www/html/chronik.txt
	else
		nr=${12}
		sed -i "${nr}i\\$6\}:\\$5\}:\\$t\}:\\$time" /var/www/html/chronik.txt
		nr=$((nr+1))
		sed -i "${nr},1d" /var/www/html/chronik.txt
fi
if [[ -e /var/www/html/chronik.txt ]] && [[ $(grep -vc "^$" /var/www/html/chronik.txt) == "21" ]]
	then 
		echo -n "$(tail -n +2 /var/www/html/chronik.txt)" > /var/www/html/chronik.txt
fi
echo -n "0" > /var/www/html/omx_status