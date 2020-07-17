# Twice Hi-Touch


# Pre-required softwares

## Install [Docker](https://www.docker.com/get-started)
* Download and Install with your OS

## Get source code

* $ `git clone https://hai_nguyen-NLJP@bitbucket.org/nldanang/tht-web.git`
* $ `cd tht-web`

## Directory tree 

```
├── README.md
├── backend
├── docker
├── docker-compose.yml
└── frontend
```

## Run source code

* $ `docker-compose up -d --build`
* $ `docker-compose exec backend composer install`
* $ `docker-compose exec backend cp .env.example .env`
* $ `docker-compose exec backend php artisan key:generate`
* $ `docker-compose exec backend php artisan migrate`


* $ `docker-compose exec frontend npm install`
* $ `docker-compose exec frontend npm run start`


## Done:127.0.0.1:8000 


## Option 

### Go to backend run
* $ `docker-compose exec backend /bin/bash`

### Go to Mysql run
* $ `docker-compose exec db /bin/bash`