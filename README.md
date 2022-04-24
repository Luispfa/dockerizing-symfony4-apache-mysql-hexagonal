# dockerizing-symfony4-apache-mysql-hexagonal

# Reto: Servicio para gestión de calidad de los anuncios

## Historias de usuario

* Yo, como encargado del equipo de gestión de calidad de los anuncios quiero asignar una puntuación a un anuncio para que los usuarios de idealista puedan ordenar anuncios de más completos a menos completos. La puntuación del anuncio es un valor entre 0 y 100 que se calcula teniendo encuenta las siguientes reglas:
  * Si el anuncio no tiene ninguna foto se restan 10 puntos. Cada foto que tenga el anuncio proporciona 20 puntos si es una foto de alta resolución (HD) o 10 si no lo es.
  * Que el anuncio tenga un texto descriptivo suma 5 puntos.
  * El tamaño de la descripción también proporciona puntos cuando el anuncio es sobre un piso o sobre un chalet. En el caso de los pisos, la descripción aporta 10 puntos si tiene entre 20 y 49 palabras o 30 puntos si tiene 50 o mas palabras. En el caso de los chalets, si tiene mas de 50 palabras, añade 20 puntos.
  * Que las siguientes palabras aparezcan en la descripción añaden 5 puntos cada una: Luminoso, Nuevo, Céntrico, Reformado, Ático.
  * Que el anuncio esté completo también aporta puntos. Para considerar un anuncio completo este tiene que tener descripción, al menos una foto y los datos particulares de cada tipología, esto es, en el caso de los pisos tiene que tener también tamaño de vivienda, en el de los chalets, tamaño de vivienda y de jardín. Además, excepcionalmente, en los garajes no es necesario que el anuncio tenga descripción. Si el anuncio tiene todos los datos anteriores, proporciona otros 40 puntos.
* Yo como encargado de calidad quiero que los usuarios no vean anuncios irrelevantes para que el usuario siempre vea contenido de calidad en idealista. Un anuncio se considera irrelevante si tiene una puntación inferior a 40 puntos.

* Yo como encargado de calidad quiero poder ver los anuncios irrelevantes y desde que fecha lo son para medir la calidad media del contenido del portal.

* Yo como usuario de idealista quiero poder ver los anuncios ordenados de mejor a peor para encontrar fácilmente mi vivienda.

### Requisitos mínimos

A continuación se enumeran los requisitos mínimos para ejecutar el proyecto:

* PHP 8
* Symfony Local Web Server o Nginx.

### Este ejemplo esta elaborado con dos tipos de Repositorios
* src\Infrastructure\Persistence\InFileSystemPersistence.php
    *   Los datos son obtenidos desde un ARRAY
* src\Infrastructure\Persistence\DoctrineSystemPersistence.php
    * os datos son obtenidos desde una Base de datos

* Para probar cada repositorio, basta con cambiar el respositorio que se inyectará a cada endPoint
    * debemos ir a : services.yaml
    * para usar InFileSystemPersistence
    ```
         system_repository:
            class: App\Infrastructure\Persistence\InFileSystemPersistence
            public: true
    ```
    * para usar DoctrineSystemPersistence
    ```
        system_repository:
            class: App\Infrastructure\Persistence\DoctrineSystemPersistence
            public: true
    ```
### Ejecutar api

* Desde la raiz del proyecto, inicializar DOCKER  -->  .\init.sh
* verificar que esten levantados los contenedores  --> docker ps
    * 
    ```
    CONTAINER ID   IMAGE                        COMMAND                  CREATED              STATUS              PORTS                           NAMES
    2896d33ba4b2   idealista-hexagonal_apache   "/bin/sh -c 'apachec…"   59 seconds ago       Up 57 seconds       443/tcp, 0.0.0.0:8003->80/tcp   sf4_apache    
    3c0ba27b742f   phpmyadmin/phpmyadmin        "/docker-entrypoint.…"   About a minute ago   Up 58 seconds       0.0.0.0:8080->80/tcp            sf4_phpmyadmin
    d77a5cb1f0a4   idealista-hexagonal_php      "docker-php-entrypoi…"   About a minute ago   Up 58 seconds       9000/tcp                        sf4_php
    99dc12c404a9   idealista-hexagonal_mysql    "docker-entrypoint.s…"   About a minute ago   Up About a minute   3306/tcp, 33060/tcp             sf4_mysql
    ```
* Abrir un tty  -->  \idealista-hexagonal> docker exec -it sf4_php  bash
* Instalar dependecias  -->  /home/wwwroot/sf4# composer install
* Ejecutar phpunit  -->  /home/wwwroot/sf4# ./vendor/bin/simple-phpunit

* Endpoint 1 : http://localhost:8003/calculate-score
* Endpoint 2 : http://localhost:8003/public-listing
* Endpoint 3 : http://localhost:8003/quality-listing

