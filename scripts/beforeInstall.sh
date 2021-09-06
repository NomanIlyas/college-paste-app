#! /bin/sh
/bin/systemctl stop apache2
rm -fr /var/www/html/college-paste-app/*
/bin/systemctl start apache2
