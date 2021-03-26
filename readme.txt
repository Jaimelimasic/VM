copiar do servidor 
    -at2.sh
    -atualiza.service
    -crontab 
chmod 4777 at2.sh
chmod 4777 atualiza.service    
mv atualiza.service /etc/systemd/system/atualiza.service
systemctl enable atualiza
systemctl start atualiza
