# R606_eval

## Introduction
Maintenability evaluated project

### Author
Hubert Tom (forked from cdiiv)



## Setup
There is a docker environnement
```bash
docker compose up -d
```
A MYSQL database will be running on port 3306
A PHP web container on port 8080
and a PHPMyAdmin on port 8085

you can also
```bash
composer install
```
to be able to run [tests](#test)

### Migrations
Migrations will be executed when you start the project and load the web page if they aren't already there

### Test
make sure you installed the dependencies at the [setup state](#setup)

and then you can run 
```bash
    composer exec phpunit ./src/tests
```

### Linter
make sure you installed the dependencies at the [setup state](#setup)

and then you can run 
```bash
    composer exec phpstan
```
