# README

## SYSTEM REQUIREMENT

* DB
  - MySQL 5.6
* Apache 
    - 2.4
* PHP
  - 7.0
* Laravel
  - 5.5
* Composer
  - 1.4.1


## Deploy
* permission
```
chmod -R 777 bootstrap/cache
chmod -R 777 storage/logs/
chmod -R 777 storage/framework
chmod -R 777 public/media
chmod -R 777 public/tmp_uploads
```

* run
```bash
 compose install
 php artisan cache:clear
 php artisan config:clear
 php artisan view:clear
```

* run deploy
```bash
cp .env.example .env
php artisan key:generate
```
* config your database in .env
find and replace database config
```bash
vi .env
```
* run database
```bash
php artisan migrate
php artisan db:seed
```

* config AWS SNS in aws.php and replace AW*
```bash
vi config/aws.php
```

* config supervisor
````bash
https://stackoverflow.com/questions/28702780/setting-up-supervisord-on-a-aws-ami-linux-server
[program:appname-worker]
process_name=%(program_name)s_%(process_num)02d
command=php artisan queue:work
directory=/var/www/php/appname
autostart=true
autorestart=true
numprocs=1
redirect_stderr=true
stdout_logfile=/var/www/php/appname/storage/logs/queues/jobs.out.log
stderr_logfile=/var/www/php/appname/storage/logs/queues/jobs.err.log
```

* supervisor command
````bash
sudo service supervisord status
sudo service supervisord start
sudo service supervisord stop
sudo service supervisord restart
````