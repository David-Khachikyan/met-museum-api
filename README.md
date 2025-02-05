# Met museum api Readme
This README provides instructions on how to set up and install the Met museum project.

## Installation
### Clone the repository:

```git clone git@github.com:David-Khachikyan/met-museum-api.git```

### Copy the environment variables file:

```
cp ./.env.example ./.env
cp ./src/.env.example ./src/.env
cp ./src/.env.example ./src/.env.testing
```
### Set up all configurations in the .env file according to your environment.

### Run Docker Compose to bring up the project:


```docker-compose up -d```
### Enter the application container:

```docker-compose exec --user=appuser app /bin/sh```

### Inside the container, run:

```php artisan key:generate```

### Inside the container, run:

```php artisan storage:link```

This command will create a symbolic link from the public/storage directory to the storage/app/public directory, which is where files are stored.


## Usage

### Create docs folder for Swagger documentation UI
```
mkdir storage/app/public/docs
mkdir storage/app/public/docs/asset
```

###  Copy Swagger documentation ui elements from vendor if its missing

```
cp vendor/swagger-api/swagger-ui/dist/* storage/app/public/docs/asset
```

###  Regenerate Swagger documentation

```
php artisan l5-swagger:generate
```

###  Swagger documentation endpoint

```
http://localhost/api/documentation
```

### Start Composer service in detached mode

```
docker-compose up -d composer
```
This command will run composer install and php artisan migrate
