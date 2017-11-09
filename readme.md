# Movie Actors and their roles

This web app connects to the movie API, and produces a list of characters played in films, grouped by the actors name, and sorted by the film's name.

## Language and Framework

PHP 5.6.31,
Laravel framework

## Requirement
PHP 5.6.31

## Installation

1. Clone this project to your local machine
2. Change the permission of the folder `chmod -R 777 movies`
3. Change the file name of `./.env.example` to `.env`
4. Install composer `php composer install`
5. Navigate to your browser http://localhost/movie/public
## Key files
Connect to the API and get the response
```$xslt
app/Http/Controllers/API/MovieConnection.php
```
Manipulate data from the movie API
```$xslt
app/Http/Controllers/MovieController.php
```
Control page views
```$xslt
app/Http/Controllers/PageController.php
```
Control routes
```$xslt
app/Http/routes.php
```
HTML templates
```$xslt
resources/views/master.blade.php
resources/views/actors.blade.php
```
Static files
```$xslt
public/css/main.css
public/img/background.jpg
```
Test files
```$xslt
tests/MovieControllerTest.php
```
## Run the test
```$xslt
./vendor/bin/phpunit
```