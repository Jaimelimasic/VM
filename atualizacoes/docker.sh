#!/bin/sh
#ativar placa de rede (IP FIXO)
dhclient eth0
ifconfig eth0:1 10.91.48.250/24