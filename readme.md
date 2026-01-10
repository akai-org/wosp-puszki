# WOSP-puszki

Monorepo for WOSP-puszki project. In 'server' directory you
can find backend code, in 'client' directory you
can find frontend code with their respective READMEs.

## Deployment

0. Requirements: `docker`, `docker compose`, editor of your choice

1. Copy the `.env.laravel.example` to `.env.laravel`

2. Fill this file

3. Run `docker compose -d`

In case of the need for refreshing, use:

```
docker compose down
docker compose build --no-cache
docker compose up -d
```

## Deployment structure:

Deployment contains the following containers:

- db - postgres database that's available under port 5432
- proxy - nginx instance that handles both frontend and backend access, available under port 80
- client - react application that creates frontend for users
- server - laravel application that handles user traffic
- scheduler - laravel application that handles all scheduled actions like backups + local access, available under port 8000
