# SQ1 Test

## Requirements

The main objetive of the test was implement a website where our users could be able to see a variety of home appliances, creating a wishlist of their favourite ones which can be shared with friends.

Live demo can be found at:

[DEMO](http://square1.gergonzalez.com)

## Getting Started

### Prerequisites

* PHP >= 7.1.3
* OpenSSL PHP Extension
* PDO PHP Extension
* Mbstring PHP Extension
* Tokenizer PHP Extension
* XML PHP Extension
* Ctype PHP Extension
* JSON PHP Extension
* Composer
* Mysql

### Installing

2 ways:

An autodeployed docker image was added for easily deploy the app. To use it:

1. Install Docker ( https://www.docker.com/community-edition )

2. In a terminal window go to the project *dockerserver* folder and execute.

```
docker-compose up
```

3. Once docker installation and app auto deployment finish (Several minutes depending on internet connection), in a browser window go to *http://localhost:8088* and start testing.

Or for a normal installation in a local server. In a terminal window:

1. Execute **composer install** in the provided source root directory to install
the dependencies.

```
composer install
```

2. Update storage folder permits.

```
sudo chmod -R 777 storage/
```

3. Create a new database in Mysql.
4. Duplicate .env.example file as .env and update it with the real database variables.
5. Set Laravel application key.

```
php artisan key:generate
```

6. Migrate the database. Execute **php artisan migrate** in the root directory.

```
php artisan migrate
```

7. Seed the database using **php artisan db:seed** command.

```
php artisan db:seed
```

## TDD

Technical design document about the approach and decisions made can be found [here](docs/tdd.pdf)

## License

This project is licensed under the MIT License - see the [LICENSE.md](LICENSE.md) file for details
