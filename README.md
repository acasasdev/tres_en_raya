## Clonar el proyecto

https://github.com/acasasdev/tres_en_raya.git tres_en_raya

## Entrar al proyecto

cd tres_en_raya

## Instalar dependencias 

### Windows

docker run --rm --interactive --tty --volume ${pwd}:/app composer install

### Linux

docker run --rm -v $(pwd):/app composer install

## Levantar el proyecto en docker

docker-compose up -d

## Crearción de tablas de la BBDD

docker-compose exec app php artisan migrate

## Acceder al proyecto

Abrir en el navegador http://localhost


#### Notas

El uso de WSL2 en Windows con Docker puede realentizar el funcionamiento del proyecto 
