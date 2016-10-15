##Prerequisites

- MySQL
- Composer

## Project setup

### Clone the repository
1. Open cmd
2. Go to the directory where you want to clone the project
3. Clone the repository `git clone https://github.com/mpeedosk/nupuvere.git`
4. Go to the root directory `cd nupuvere`

### Setting up the database _(we're using "nupuvere" as the default name)_
4. Open the .env.example file in notepad
5. In the file, set up the following:
    * DB_USERNAME set this to your mysql username (default is root)
    * DB_PASSWORD set this to your mysql password
6. Save the file as .env
7. Back in cmd execute `mysql -u root -p` and enter your mysql password, or use the MySQL command line client
    * execute `create database nupuvere;`
    * execute `use nupuvere;`
    * to exit mysql cmd type `quit;`

### Installing the project
8. Install the dependencies `composer install`
9. Populate the database `php artisan migrate --seed`
10. Launch the website `php artisan serve`
11. Open in your browser `http://localhost:8000`

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
