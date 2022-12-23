## About
A simple Login and Crud application which allows users to login and
manage subscribers using datatable features. Users can log in using
a unique user code and password. The code is assigned automatically
during user creation, starts from 1981 and increments 1 on each new user creation.
New User creations can only be made through the default user, 
no other user can create a new user.


## Installation

Install application using below instructions.

- Run following commands in your terminal
```bash
  git clone https://github.com/camaraousman/Login-And-Crud.git
  cd Login-And-Crud
  composer update
  cp .env.example .env
  php artisan key:generate
  php artisan storage:link
  php artisan migrate --seed
  php artisan serve
```

- In your browser, open
```bash
  http://127.0.0.1:8000/
```
- Default User Code and Password
```bash
  code: 1981
  password: password
```
