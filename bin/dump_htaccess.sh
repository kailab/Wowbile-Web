#!/bin/sh

export SYMFONY__DATABASE__NAME=wowbile
export SYMFONY__DATABASE__USER=root
export SYMFONY__DATABASE__PASSWORD=
export SYMFONY__DATABASE__SOCKET="/var/run/mysqld/mysqld.sock"

cat > web/.htaccess << "EOF"

SetEnv SYMFONY__DATABASE__NAME wowbile
SetEnv SYMFONY__DATABASE__USER root
SetEnv SYMFONY__DATABASE__PASSWORD 
SetEnv SYMFONY__DATABASE__SOCKET /var/run/mysqld/mysqld.sock

RewriteEngine On
EOF

./app/console router:dump-apache --env=prod --base-uri=/wowbile >> web/.htaccess
