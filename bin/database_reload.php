#!/bin/bash
php app/console --force doctrine:database:drop
php app/console doctrine:database:create
php app/console doctrine:schema:create
php app/console fos:user:create admin admin@wowbile.eu admin01
pgp app/consolse fos:user:promote admin
