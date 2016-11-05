##Prerequisites

- [MySQL] (http://dev.mysql.com/downloads/file/?id=466291)
Click the "No thanks, just start my download." link. Install MySQL with the developer default settings.
- [Composer](https://getcomposer.org/)
- PHP >= 5.6
Best way is to download [XAMPP](https://www.apachefriends.org/index.html) for your desired platform and install with the default settings.

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
    * DB_PASSWORD set this to your mysql password (if you're using the default root user, then the password is what you entered at installation)
6. Save the file as .env
7. Open the  MySQL command line client and enter your root password
    * execute `create database nupuvere;`
    * execute `use nupuvere;`
    * to exit mysql cmd type `quit;`

### Installing the project
8. Install the dependencies `composer install`
9. Generate a new app key `php artisan key:generate`
10. Populate the database `php artisan migrate --seed`
11. Launch the website `php artisan serve`
12. Open in your browser `http://localhost:8000`

###
* You can log in with the username `user` and password `parool`
* You can log in as admin with the username `admin` and password `parool`
 
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
