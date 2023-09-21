# Amigasource

This is a web directory dedicated to the Amiga.

## Development

To set up the development environment, run `docker compose up -d` in the root directory. Then run the following command to install the database data.

Note: the database data will have to come from a production dump, or you can start with just the schema and no data.

```bash
docker exec -i amigasource-db-1 sh -c 'exec mysql -uroot -p"root"' < ./database/localhost.sql
```

You only have to do this once. From then on you can just run `docker compose up -d` to start the environment and `docker compose down` to shut it down.
