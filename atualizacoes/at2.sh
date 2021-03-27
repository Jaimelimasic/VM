#!/bin/bash
sudo date > /home/ubuntu/at2.log
if sudo docker ps | grep "fairplay";then
  echo "doker fairplay ok" >> /home/ubuntu/at2.log
else
  echo "doker fairplay caido" > /home/ubuntu/at2.log
  errdock=1
fi
if sudo docker ps | grep "widevine";then
  echo "doker widevine ok" >> /home/ubuntu/at2.log
else
  echo "doker widevine caido" >> /home/ubuntu/at2.log
  errdock=1
fi
if [ "$errdock" -eq "1" ];then
  docker stop $(docker ps -a -q)
  docker run -d --restart always -p 81:80 -p 444:443 -v /home/ubuntu/widevine/config:/Config -v /home/ubuntu/widevine/logs:/Logs registry.axinom.com/widevine-api-armhf/app
  docker run -d --restart always -p 82:80 -p 445:443 -v /home/ubuntu/fairplay/config:/Config -v /home/ubuntu/fairplay/logs:/Logs registry.axinom.com/fairplay-api-armhf/app
else
  echo "Dokers ativos e ok" >> /home/ubuntu/at2.log
fi
if ping -q -c 1 -W 1 veronline.rocks >/dev/null; then
  echo "Tenho internet vou tentar atualizar-ok 
" >> /home/ubuntu/at2.log
else
  echo "Estou sem internet vou sair
" >> /home/ubuntu/at2.log
  exit
fi
#echo "Agora vamos dar uma olhada no docker" >> /home/ubuntu/at2.log
docker login -u figueiro -p U3nhk3RfmsfKk6F registry.axinom.com;
docker pull registry.axinom.com/fairplay-api-armhf/app:latest;
docker pull registry.axinom.com/widevine-api-armhf/app:latest;
date >> /home/ubuntu/at2.log