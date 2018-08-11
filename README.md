
# Kanban Services

## Setup Project


### Update required environment variables (if needed)

> $ vim .env


### Build your application

> $ sudo docker-compose up -d --build

Note: Give 5-10 minutes to setup your environment


### Verify all containers

> $ sudo docker ps

You also may verify from browsers via http://127.0.0.1:81/


### Run Migrations

> $ sudo docker exec -i -t kanban_services_workspace_1 /bin/bash

> $ php artisan migrate


--

# Other Required Things:


## List of containers and access

In this example, we are going to view a list of all containers then access workspace to see php

> $ sudo docker ps


### Workspace Container
> $ sudo docker exec -i -t kanban_services_workspace_1 /bin/bash


### MySQL Container
> $ sudo docker exec -i -t kanban_services_mysql_1 /bin/bash

> $ php artisan


## Remove any specific container

### Stopping all containers:
> $ sudo docker kill $(sudo docker ps -q)
or
> $ sudo docker kill kanban_services_workspace_1

### Removing containers:
> $ sudo docker rm -f kanban_services_workspace_1
or 
> $ sudo docker rm $(sudo docker ps -a -q) #all

### Removing all docker images
> $ sudo docker rmi $(sudo docker images -q)
or
> $ sudo docker rmi -f $(sudo docker images -q)


## Install Docker Composer (if not exists)

> $ sudo curl -L https://github.com/docker/compose/releases/download/1.21.2/docker-compose-$(uname -s)-$(uname -m) -o /usr/local/bin/docker-compose

> $ sudo chmod +x /usr/bin/docker-compose

> $ systemctl start docker

> $ systemctl status docker
