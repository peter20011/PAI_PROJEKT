
<p align="center">
<img src="public/img/logo.svg" width="250" height="250">
</p>

# BOOKBAND

A web application where you can book and rate bands from all the world.


# Technologies
- PHP
- JS
- HTML/CSS
- PostgreSQL


# Requirements
- [Docker](https://www.docker.com/)


# Installation

1. Clone the repository from Github:

```
git clone https://github.com/peter20011/PAI_PROJEKT.git
```

2. Create an .env file, which includes database connection details. Do not forget to add this details in constructor in class Database.php.

```
DB_NAME=
DB_USER=
DB_PASSWORD=
DB_HOST=
```

3. Open terminal and run commands:

```
docker-compose build
```

```
docker-compose up
```

4. Access it by visiting http://localhost:8080 in your web browser.


# Database

![](sql_data/diagramERD.png)

# SQL SCRIPT
- SQL script available in the folder 'sql_data'

# SCREENSHOTS

- Login
  ![](ss/Login-dekstop.PNG)
  ![](ss/Login-mobilka.PNG)

- Register User
  ![](ss/Rejestracja-user-desktop.PNG)
  ![](ss/Rejestracja-user-mobilka.PNG)

- Homepage
  ![](ss/Homepage-desktop.PNG)
  ![](ss/Homepage-mobilka.PNG)

- Band Profile
  ![](ss/BandProfile-desktop.PNG)
  ![](ss/BandProfile-mobilka.PNG)

- Change password
  ![](ss/ZmianaHasła-desktop.PNG)
  ![](ss/ZmianaHasła-mobilka.PNG)