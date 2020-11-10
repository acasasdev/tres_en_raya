## Clonar el proyecto

git clone https://github.com/acasasdev/tres_en_raya.git tres_en_raya

## Entrar al proyecto

cd tres_en_raya

## Instalar dependencias 

- ### Windows

    - docker run --rm --interactive --tty --volume ${pwd}:/app composer install

- ### Linux

   - docker run --rm -v $(pwd):/app composer install

## Levantar el proyecto en docker

docker-compose up -d

## Crearción de tablas de la BBDD

docker-compose exec app php artisan migrate

## Acceder al juego

Abrir en el navegador http://localhost


#### Notas de desarrollo

- El juego se ha desarrollado usando el framework de php laravel, html, js y css

- El entorno está construido con Nginx, PHP 7.3 y MySQL bajo Docker

- La base de datos se genera de manera automática y sus tablas se crean usando migraciones de laravel

- Los ficheros más relevantes son :

    - app\Http\Controllers\GameBoardController.php => Se encarga de dar de alta el tablero de juego en la BBDD
    - app\Http\Controllers\GameBoardPositionController.php => Se encarga de almacenar las posiciones de los jugadores en la BBDD y gestionar la lógica de victoria
    - resources\views\game_screen.php => vista de la pantalla de juego
    - resources\js\app.js => gestiona la interacción de los jugadores con la pantalla de juego y realiza las peticiones a la API de PHP

#### Notas de uso

- El juego conserva el estado de la partida mientras el usuario no cierre el navegador o comienze una nueva partida
- Se puede continuar la partida actual cuando se recarga la página o se abre en otra pestaña

#### Notas de rendimiento

El uso de WSL2 en Windows con Docker puede realentizar el funcionamiento del proyecto 
