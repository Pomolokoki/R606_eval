# R606_eval

# Introduction
Maintenability evaluated project

# Setup
There is a docker environnement
```bash
docker compose up -d
```
A MYSQL database will be running on port 3306
A PHP web container on port 8080
and a PHPMyAdmin on port 8085

### Migrations
Migrations will be executed when you start the project and load the web page if they aren't already there