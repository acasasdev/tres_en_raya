## Instalar dependencias 

docker run --rm --interactive --tty --volume ${pwd}:/app composer install

## Levantar el proyecto en docker

docker-compose up -d

## Crearción de tablas de la BBDD

docker-compose exec app php artisan migrate
