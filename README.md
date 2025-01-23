# Configuración de Desarrollo Local

Esta documentación proporciona instrucciones sobre cómo configurar y ejecutar el proyecto en un entorno de desarrollo local utilizando Docker y Docker Compose.

## Pre requisitos

Asegúrate de tener lo siguiente instalado en tu máquina local:
- Docker
- Docker Compose
- (Si utilizas Windows) WSL para poder ejecutar los comandos de Makefile

## Pasos para Ejecutar el Proyecto

1. **Clonar el Repositorio:**
  ```sh
  git clone <repository-url>
  cd <repository-directory>
  ```

2. **Crear un Archivo `.env`:**
  Asegúrate de tener un archivo `.env` en el directorio raíz con el siguiente contenido como ejemplo (Se pueden modificar los valores DB_DATABASE, DB_USERNAME y DB_PASSWORD):
  ```env
    APP_ENV=local
    DB_CONNECTION=mysql
    DB_HOST=mysql
    DB_DATABASE=challenge_db
    DB_USERNAME=challenge_user
    DB_PASSWORD=challenge_pwd
  ```

3. **Crear un Archivo `.env.testing`:**
  Asegúrate de tener un archivo `.env.testing` para ejecutar las pruebas de funcionalidad en el directorio raíz con el siguiente contenido:
  ```env
    APP_ENV=testing
    DB_CONNECTION=sqlite
    DB_DATABASE=:memory:
  ```

4. **Construir e Iniciar los Contenedores Docker:**
  Usa el Makefile para construir e iniciar los contenedores Docker:
  ```sh
    make start
  ```
  Para ambiente de testing
  ```sh
    make start APP_ENV=testing
  ```

5. **Ejecutar migraciones:**
  Usa el Makefile para ejecutar las migraciones de Laravel:
  ```sh
    make deploy-migrations
  ```

6. **Ejecutar seeds:**
  Usa el Makefile para ejecutar los seeds de Laravel:
  ```sh
    make deploy-seed
  ```

7. **Acceder a la Aplicación:**
  Una vez que los contenedores estén en funcionamiento, puedes acceder a la aplicación en `http://localhost`.


8. **Detener los Contenedores:**
  Para detener los contenedores en ejecución, usa:
  ```sh
  make stop
  ```

## Testing

Para realizar los test, recuerde estar en ambiente testing **(APP_ENV=testing)** y ejecute los siguientes comandos:
  ```sh
  php artisan test tests/Feature/ArticleViewTest
  ```
  ```sh
  php artisan test tests/Feature/ArticleDeleteTest
  ```
  ```sh
  php artisan test tests/Feature/ArticleCreateTest
  ```

## Notificaciones

Para poder probar la funcionalidad de las notificaciones por mail se recomienda la utilizacion de Mailtrap https://mailtrap.io/

Configurar a continuacion en el archivo .env de su ambiente local:

  ```env
    MAIL_MAILER=smtp
    MAIL_HOST=sandbox.smtp.mailtrap.io
    MAIL_PORT=2525
    MAIL_USERNAME={mailtrap_username}
    MAIL_PASSWORD={mailtrap_password}
  ```

## Notas

- En la raiz del proyecto se encuentra la coleccion de Postman llamada Challenge.postman_collection.json.
