#!/bin/sh
#Fazer Login:
#docker login -u figueiro -p U3nhk3RfmsfKk6F registry.axinom.com
#Baixar Container fairplay
#docker pull registry.axinom.com/fairplay-api-armhf/app:latest
#Baixar Container widevine
#docker pull registry.axinom.com/widevine-api-armhf/app:6.15.1&
#docker pull registry.axinom.com/widevine-api-armhf/app:latest&

#Instalarçoes iniciaris
#apt update
#apt upgrade
#apt install mc
#apt install apache2
#apt install php 
#apt install sshpass
#apt install 


#subir os dockers 
#docker stop $(docker ps -a -q)
#docker run -d --restart always -p 81:80 -p 444:443 -v /home/ubuntu/widevine/config:/Config -v /home/ubuntu/widevine/logs:/Logs registry.axinom.com/widevine-api-armhf/app
#docker run -d --restart always -p 82:80 -p 445:443 -v /home/ubuntu/fairplay/config:/Config -v /home/ubuntu/fairplay/logs:/Logs registry.axinom.com/fairplay-api-armhf/app
##########################################################################################################################################################################

#ativar placa de rede (IP FIXO)
dhclient eth0
ifconfig eth0:1 10.91.48.250/24
delay 40
sh /home/ubuntu/at2.sh