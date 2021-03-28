#!/bin/bash
date > /home/ubuntu/at2.log
errdock=0
#**************************
#docker ps >> /home/ubuntu/at2.log
if d | grep "fairplay";then
  echo "doker fairplay ok" >> /home/ubuntu/at2.log
else
  echo "doker fairplay caido" >> /home/ubuntu/at2.log
  errdock=1
fi
#docker ps >> /home/ubuntu/at2.log
if d | grep "widevine";then
  echo "doker widevine ok" >> /home/ubuntu/at2.log
else
  echo "doker widevine caido" >> /home/ubuntu/at2.log
  errdock=1
fi
echo $errdock >> /home/ubuntu/at2.log
delay 30
#***************************
date >> /home/ubuntu/at2.log