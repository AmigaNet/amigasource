#!/usr/bin/env bash
files=$(ls ./database/seeders/*.php)
for file in $files
do
  echo "Seeding $file"
  docker exec -i amigasource-php-fpm-1 sh -c "exec php $file"
done
