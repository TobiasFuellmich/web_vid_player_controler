#!/bin/bash
#install
echo "intallation :"
apt-get install lighttpd
apt-get install php
apt-get install php-cgi
apt-get install mediainfo
apt-get install youtube-dl
pip install --upgrade youtube-dl
sudo wget https://yt-dl.org/downloads/latest/youtube-dl -O /usr/local/bin/youtube-dl
sudo chmod a+rx /usr/local/bin/youtube-dl
#config
echo "config :"
lighty-enable-mod fastcgi
lighty-enable-mod fastcgi-php
if [[ $(grep -F "pip install --upgrade youtube-dl" /etc/rc.local) == "" ]];then
while [[ $(grep -F "exit 0" /etc/rc.local) != "" ]];do
sed -i "$ d" /etc/rc.local;done
echo "pip install --upgrade youtube-dl" >> /etc/rc.local
echo "exit 0" >> /etc/rc.local;fi
if [[ $(grep -F "wlan0" /etc/network/interfaces) == "" ]];then
echo 'wlan einrichten ? (y/n) : '
read wlanconfig;fi
if [[ $wlanconfig == "y" ]];then
echo 'ssid (name) : '
read ssid
ssid='"'$ssid'"'
echo 'pw (Passwort) : '
read pw
pw='"'$pw'"'
echo 'gateway 192.168.%n%.1 was ist %n% ? : '
read n
echo "" >> /etc/network/interfaces
echo "auto wlan0" >> /etc/network/interfaces
echo "allow-hotplug wlan0" >> /etc/network/interfaces
echo "iface wlan0 inet static" >> /etc/network/interfaces
echo "address 192.168.$n.111" >> /etc/network/interfaces
echo "wpa-ssid "$ssid >> /etc/network/interfaces
echo "wpa-psk "$pw >> /etc/network/interfaces;fi
#remove files
echo "remove files :"
rm -f /var/www/html/*
#copy/create files
echo "copy/create files :"
mkdir /var/www/html/external
mv -f php.ini /etc/php/7.0/cgi/php.ini
mv index.php /var/www/html/index.php
mv index.css /var/www/html/index.css
mv stream.php /var/www/html/stream.php
mv chronik.php /var/www/html/chronik.php
mv einstellungen.php /var/www/html/einstellungen.php
mv getconfig.inc /var/www/html/getconfig.inc
mv ajax.js /var/www/html/ajax.js
mv control_vid.php /var/www/html/control_vid.php
mv omx_dir.php /var/www/html/omx_dir.php
mv omx_online.php /var/www/html/omx_online.php
mv ud_youtube_dl.php /var/www/html/ud_youtube_dl.php
mv reset_omx.php /var/www/html/reset_omx.php
mv req_post.py /var/www/html/req_post.py
mv sound.png /var/www/html/sound.png
mv yt_b1.png /var/www/html/yt_b1.png
mv yt_b2.png /var/www/html/yt_b2.png
mv yt_b3.png /var/www/html/yt_b3.png
mv b4.png /var/www/html/b4.png
mv b5.png /var/www/html/b5.png
mv sc_b1.png /var/www/html/sc_b1.png
mv sc_b2.png /var/www/html/sc_b2.png
mv sc_b3.png /var/www/html/sc_b3.png
mv raw_b1.png /var/www/html/raw_b1.png
mv raw_b2.png /var/www/html/raw_b2.png
mv raw_b3.png /var/www/html/raw_b3.png
mkfifo /var/www/html/fifo
tr -d '\015' <play.sh >/var/www/html/play.sh
tr -d '\015' <playyt.sh >/var/www/html/playyt.sh
tr -d '\015' <playsc.sh >/var/www/html/playsc.sh
tr -d '\015' <follow_omx.sh >/var/www/html/follow_omx.sh
tr -d '\015' <ud_youtube_dl.sh >/var/www/html/ud_youtube_dl.sh
tr -d '\015' <reset_omx.sh >/var/www/html/reset_omx.sh

echo -n "0" > /var/www/html/omx_status

echo 'echo -n "q" > /var/www/html/fifo' > /var/www/html/quit.sh
echo 'echo -n "p" > /var/www/html/fifo' > /var/www/html/pause.sh
echo 'echo -n ">" > /var/www/html/fifo' > /var/www/html/faster.sh
echo 'echo -n "<" > /var/www/html/fifo' > /var/www/html/backwards.sh
echo 'echo -n "+" > /var/www/html/fifo' > /var/www/html/louder.sh
echo 'echo -n "-" > /var/www/html/fifo' > /var/www/html/quieter.sh
echo 'echo -n $"\e"[A > /var/www/html/fifo' > /var/www/html/10min_for.sh
echo 'echo -n $"\e"[B > /var/www/html/fifo' > /var/www/html/10min_back.sh
echo 'echo -n $"\e"[C > /var/www/html/fifo' > /var/www/html/30s_for.sh
echo 'echo -n $"\e"[D > /var/www/html/fifo' > /var/www/html/30s_back.sh
#setting permissions
echo "setting permissions :"
chmod 777 /var/www/html/fifo
chmod +x /var/www/html/follow_omx.sh
chmod +x /var/www/html/play.sh
chmod +x /var/www/html/playyt.sh
chmod +x /var/www/html/playsc.sh
chmod +x /var/www/html/ud_youtube_dl.sh
chmod +x /var/www/html/quit.sh
chmod +x /var/www/html/pause.sh
chmod +x /var/www/html/faster.sh
chmod +x /var/www/html/backwards.sh
chmod +x /var/www/html/louder.sh
chmod +x /var/www/html/quieter.sh
chmod +x /var/www/html/10min_for.sh
chmod +x /var/www/html/10min_back.sh
chmod +x /var/www/html/30s_for.sh
chmod +x /var/www/html/30s_back.sh
chown www-data -R /var/www/
gpasswd -a www-data video
