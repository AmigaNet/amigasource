#!/usr/bin/env bash
files=$(ls ./database/migrations/*.sql)
for file in $files
do
  echo "Migrating $file"
  docker exec -i amigasource-db-1 sh -c 'exec mysql -uroot -p"root" asdb' < $file
done
