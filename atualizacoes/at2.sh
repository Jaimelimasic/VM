#!/bin/bash
docker login -u figueiro -p U3nhk3RfmsfKk6F registry.axinom.com
docker pull registry.axinom.com/fairplay-api-armhf/app:latest
#docker pull registry.axinom.com/widevine-api-armhf/app:6.15.1
docker pull registry.axinom.com/widevine-api-armhf/app:latest
