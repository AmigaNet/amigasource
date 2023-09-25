#!/usr/bin/env bash
docker exec -i amigasource-db-1 sh -c 'exec mysql -uroot -p"root" -e "DROP DATABASE asdb;"'
docker exec -i amigasource-db-1 sh -c 'exec mysql -uroot -p"root" -e "CREATE DATABASE asdb;"'
docker exec -i amigasource-db-1 sh -c 'exec mysql -uroot -p"root" asdb' < ./database/schema.sql
docker exec -i amigasource-db-1 sh -c 'exec mysql -uroot -p"root" asdb' < ./database/data.sql