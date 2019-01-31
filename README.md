# SnowTricks

[![Codacy Badge](https://api.codacy.com/project/badge/Grade/45ff1214e55a46bdab5e87c787ece7bf)](https://app.codacy.com/app/ludovicjj/p6-snowtricks?utm_source=github.com&utm_medium=referral&utm_content=ludovicjj/p6-snowtricks&utm_campaign=Badge_Grade_Dashboard)

## Project

*   PHP 7.2
*   Symfony 4.2
*   Doctrine
*   Twig

## How to instal

*   Download project :  
```
https://github.com/ludovicjj/p6-snowtricks.git 
```
*   Install Dependencies : 
```
composer install 
```

*   Database : 
The database connection information is stored as an environment variable called DATABASE_URL. You can find and customize this inside .env 
Replace ```root``` by your username and add your password after ```:```
```
DATABASE_URL=mysql://root:@127.0.0.1:3306/lj_snowtricks
```

*   Create database : 
```
php bin/console doctrine:database:create
```
*   Install fixtures : 
```
php bin/console doctrine:fixtures:load
```
*   Project launch : 
```
php bin/console server:run
```

##  E-mail configuration

Using Gmail to Send Emails.
Update the MAILER_URL of .env file.

```MAILER_URL=gmail://username:password@localhost```

username is your full Gmail or Google Apps email address

If your Gmail account uses 2-Step-Verification, you must generate an App password and use it as the value of the mailer password. You must also ensure that you allow less secure apps to access your Gmail account.


