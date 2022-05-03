# dockerizing-symfony4-apache-mysql-hexagonal

### Start

* Desde la raiz del proyecto, inicializar DOCKER
    ```
    \symfony4-apache-mysql-hexagonal> .\init.sh
    ```
* verificar que esten levantados los contenedores
    ```
     \symfony4-apache-mysql-hexagonal> docker ps
    ```

```
CONTAINER ID   IMAGE                                               COMMAND                  CREATED      STATUS        PORTS                 NAMES
da5dcc00a9ca   dockerizing-symfony4-apache-mysql-hexagonal_mysql   "docker-entrypoint.s…"   3 days ago   Up 1 second   3306/tcp, 33060/tcp   sf4_mysql
PS C:\Users\Luis Flores\proyectos\dockerizing-symfony4-apache-mysql-hexagonal> docker ps
CONTAINER ID   IMAGE                                                COMMAND                  CREATED      STATUS          PORTS
            NAMES
94a4cfab69b3   dockerizing-symfony4-apache-mysql-hexagonal_apache   "/bin/sh -c 'apachec…"   3 days ago   Up 4 seconds    443/tcp, 0.0.0.0:8003->80/tcp   sf4_apache
c827707f87d6   phpmyadmin/phpmyadmin                                "/docker-entrypoint.…"   3 days ago   Up 6 seconds    0.0.0.0:8080->80/tcp            sf4_phpmyadmin
e3a118594715   dockerizing-symfony4-apache-mysql-hexagonal_php      "docker-php-entrypoi…"   3 days ago   Up 6 seconds    9000/tcp
            sf4_php
da5dcc00a9ca   dockerizing-symfony4-apache-mysql-hexagonal_mysql    "docker-entrypoint.s…"   3 days ago   Up 13 seconds   3306/tcp, 33060/tcp 
            sf4_mysql
```
* Abrir un tty
```
\symfony4-apache-mysql-hexagonal> docker exec -it sf4_php  bash
```
* Instalar dependecias
```
/var/www/sf4# composer install
```
* Ejecutar phpunit
```
/var/www/sf4# ./vendor/bin/simple-phpunit
```
* Via API
    * Endpoint 1 : http://localhost:8003/calculate-score
    * Endpoint 2 : http://localhost:8003/public-listing
    * Endpoint 3 : http://localhost:8003/quality-listing
    * Endpoint 4 : http://localhost:8003/get-ad/2
    * phpMyAdmin : http://localhost:8080/

* Via Console Commands
    * Open a tty: docker exec -it sf4_php  bash
    * Execute:
        * command 1 : php bin/console app:calculate-score
        * command 2 : php bin/console app:get-ad 2 

### Considerations 
* src\Infrastructure\Persistence\InFileSystemPersistence.php
    * Los datos son obtenidos desde una clase PHP
* src\Infrastructure\Persistence\DoctrineSystemPersistence.php
    * Los datos son obtenidos desde una Base de datos

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

* PHP 7
* Symfony Local Web Server o Apache.