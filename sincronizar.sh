#atualizador_autonomo_novo_09-2021VI-ok
#!/bin/sh
clear
ssh-keygen -f "/root/.ssh/known_hosts" -R "veronline.rocks"
################ Variaveis Locais ###################################
rm /tmp/serial
cat /proc/cpuinfo|grep Serial|cut -d ':' -f2|head -n1 > /tmp/serial
serial=$(sed s/'\s'//g /tmp/serial)
base=$(sed s/'\s'//g /home/ubuntu/base)
echo "serial=$serial"
echo "base=$base"
#####################################################################
#!/bin/bash
for i in 1 2 3 4 5 6 7 8 9
do 
	killall rsync
	echo $i
done
#####################################################################
user_f=ubuntu
senha_f="Gr3g0r1o&B14"
porta_f=7722
master=veronline.rocks
#####################################################################
echo "backup"
	sshpass -p $senha_f rsync -vazhP -e "ssh -p $porta_f" $user_f@veronline.rocks:/VM/atualizacoes/sincronizar.sh /home/ubuntu/sincronizar.sh
	sshpass -p $senha_f rsync -vazhP -e "ssh -p $porta_f" $user_f@veronline.rocks:/VM/$base/sincronizar.sh /home/ubuntu/sincronizar.sh
	chmod 777 /home/ubuntu/sincronizar.sh
echo "Sincronizar Certificados"
sshpass -p $senha_f rsync -vazhP --partial --inplace -e "ssh -p $porta_f" $user_f@$master:/VM/certificado/ /home/ubuntu/certificado/

cp /home/ubuntu/certificado/*.pem /home/ubuntu/widevine/config/
cp /home/ubuntu/certificado/*.pem /home/ubuntu/fairplay/config/
cp /home/ubuntu/certificado/DeviceCertificateStatusList.json /home/ubuntu/widevine/config/DeviceCertificateStatusList.json

#echo "Sincronizar Inicialização" 
	sshpass -p $senha_f rsync -vazhP --partial --inplace -e "ssh -p $porta_f" $user_f@$master:/VM/atualizacoes/docker.sh /home/ubuntu/docker.sh
    chmod 777 /home/ubuntu/docker.sh

#echo "atualização de containers"
	sshpass -p $senha_f rsync -vazhP --partial --inplace -e "ssh -p $porta_f" $user_f@$master:/VM/atualizacoes/at2.sh /home/ubuntu/at2.sh
    chmod 777 /home/ubuntu/at2.sh

#echo "Sincronizar HTML"
	sshpass -p $senha_f rsync -vazhP --partial --inplace --exclude '*.txt' --exclude 'midia' --exclude 'stats' -e "ssh -p $porta_f" $user_f@$master:/VM/www/ /var/www/html/
#echo "Sincronizar Filmes criptografados e capas pela nuvem"
#    sshpass -p "Gr3g0r1o#B14#Gr3g0r1o%880" rsync -vazhP --delete -e "ssh -p 22" drm@veronline.center:/home/drm/encoded_Prontos/ /var/www/html/midia/
######################################################################
#echo "Sincronizar Crontab"
	sshpass -p $senha_f rsync -vazhP --partial --inplace -e "ssh -p $porta_f" $user_f@$master:/VM/atualizacoes/crontab /etc/crontab
	chown root /etc/crontab
	chmod 644 /etc/crontab
#echo "Sincronizar Filmes criptografados e capas"
	sshpass -p $senha_f rsync -azhP --partial --inplace --delete -e "ssh -p $porta_f" $user_f@$master:/VM/filmes/ /var/www/html/midia/
	sshpass -p $senha_f rsync -vazhP --partial --inplace -e "ssh -p $porta_f" $user_f@$master:/VM/txt/*.txt /var/www/html/
#echo "Sincronizar Estatisticas"
chmod 777 /var/www/html/writestat.php
chmod 777 /var/www/html/writeid.php
mkdir /var/www/html/stats
chmod 777 /var/www/html/stats
echo $serial > /var/www/html/stats/vm.dat
sshpass -p "Gr3g0r1o#B14#Gr3g0r1o%880" rsync --remove-source-files -vazhP /var/www/html/stats/ drm@veronline.center:/home/drm/stat/stat_$serial
sshpass -p "Gr3g0r1o#B14#Gr3g0r1o%880" rsync -vazhP  drm@veronline.center:/home/drm/stat/stat_$serial/base.dat /home/ubuntu/base.dat
#echo "testeipirang" > /var/www/html/stats/idrouter.dat
rm /home/ubuntu/sincronizar2.sh