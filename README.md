##Prerequisites

- MySQL
- Composer

## Project setup

### Clone the repository
1. Go to the directory where you want to clone the project
2. Open cmd
2. Clone the repository `git clone https://github.com/mpeedosk/nupuvere.git`
3. Go to the root directory `cd nupuvere`

### Setting up the database _(we're using "nupuvere" as the default name)_
4. Copy and rename the .env.example to .env
5. In the .env file, set up the following:
    * DB_USERNAME set this to your mysql username
    * DB_PASSWORD set this to your mysql password
6. Back in cmd execute `mysql -u root -p` and enter your mysql password
    * execute `create database nupuvere;`
    * to exit mysql cmd type `\q`

### Installing the project
7. install the dependencies `composer install`
8. populate the database `php artisan migrate --seed`
9. Open in your browser `http://localhost:8000`

###
* You can log in with the username `user` and password `parool`

##License
MIT License

See LICENSE for details.

##Authors
- Martin Liba
- Alo Vals
- Martin Peedosk
- Helbe-Laura Nikitkina

##Live Demo
https://nupuvere-test.herokuapp.com/
