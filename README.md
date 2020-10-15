

## Frog Simulation Idea

This is a simulation based on the Frog Asia challenge. The idea is to have a simulation where you create a number of frogs to interact in a limited space. Based on their distance in the simulation world, gender, energy (Introverted, Extroverted), and cognitive stack ('NT','TN','FN','NF','ST','TS','FS','SF'). This is based on the Jungian cognitive functions approach in typing/classifying the Frogs.
The frogs are supposed to find their nearest best mates and reproduce before their lifespan runs out. 
Will these picky amphibians find their long lost love or get extinct before the world ends?

Note that I haven't been able to finish my idea completly, but stay with me cause I will through time.


## Frog Simulation Backend

It has 3 main API endpoints

- Register: /api/register
- Login: /api/login
- Create Simulation: /api/simulation 

After you register and login, using the token you can create a simulation.
The endppoints are RESTfull and I am using Laravel Passport to secure the authentication. 

## Installation

First download the code using git or any other way you prefer:
```bash
https://github.com/YasharZand/frog-tail.git
```
Then install all dependancies by running composer in the workspace root directory:
```bash
composer install
php artisan key:generate
```
Set your database credentials in the .env file
Do a migrate so the schema be deployed in your database gracefullly
```bash
php artisan migrate 
```
or 
```bash
php artisan migrate:fresh
```
Lastly setup the client passport configs:
```bash
php artisan passport:install
```
Your API is ready to run if no errors up to this point.

## Running the API backend

To run the backend you can simply use:
```bash
php artisan serve
```

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
