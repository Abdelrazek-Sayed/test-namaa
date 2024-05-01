# steps to setup the project

# 1- run command    docker compose up -d --build  to start docker containers

# you will find the project run on port localhost:8000 (and php my admin on localhost:8001 but not needed so i comment it in docker file)

# 2- craete .env file

# 3- add DB_DATABASE, DB_USERNAME , DB_PASSWORD not needed as we treat with json file

# 4- then run docker compose exec app composer install

# 5- then run docker compose exec app php artisan key:generate

# you will find the postman collection in postman folder inside the project with 5 apis to make it ease for filteration

# i used modular system  with 4 layers (interface,repository,service and controller )  and make module called transactions that include all folders

# to make the differnt json data of providers the same i used Dto to make one response and map the data and map dfferent status inside it

# you can  add easly any DataProvider in userdata config file and craete only context file for the provider response as exist

# you will find the json files inside storage/app/files and the code can easily read it and any error will be registered in jsonFileLog channel

# run this command to test the end point  'api/v1/users' docker compose exec app ./vendor/bin/phpunit --filter UserEndpointTest 

# i am sorry that i called files and api as user and complete as user not transctiosn
# thanks too much
