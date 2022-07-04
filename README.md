# EXADS TECHNICAL TEST

I chose to use pure PHP without any framework, in my opinion, this is the best way to do it in this specific case since it is a very simple application. I also chose to use the [docker-compose](https://docs.docker.com/compose/overview/) to manage the containers.

## Requirements

- Docker - [Docker](https://www.docker.com/)
- Docker Compose - [Docker Compose](https://docs.docker.com/compose/install/)

## Instructions

1. Clone this repository.
2. Run the docker-compose command inside the cloned repository.

   ```
   docker-compose up -D
   ```

   > The composer container will be stopped after installed/updated the dependencies.

3. The application will be available on [http://localhost:8080](http://localhost:8080) after the composer container will have finished the dependencies installation.

> The database will be set up automatically using the schema file in the database folder.

## Folder structure

- [database/](./database) - Contains the schema file.
- [docker/](./docker) - Contains the containers configs and data, including database logs.
- [public/](./public) - Contains the static files.
- [src/](./src) - Contains the source code.
  - [app/](./src/app) - Contains the application code.
    - [config/](./src/app/config) - Contains the application configs.
    - [models/](./src/app/models) - Contains the application models.
    - [views/](./src/app/views) - Contains the application views.
  - [library/](./src/library) - Contains the library code.
- [tests/](./tests) - Contains the tests.

## Testing

Running tests directly using docker exec:

```
 docker exec -it exads-php php vendor/bin/phpunit
```

Run the bash in the docker container

```
 docker exec -it exads-php bash
```

and then, run the tests

```
 php vendor/bin/phpunit
```

> NOTE: Some tests will use the database, the config file for that is inside the tests folder and some of these tests will use the same database that the application uses, nevertheless it is just to make all code testable.
