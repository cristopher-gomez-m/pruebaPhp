Proyecto: Citas Médicas

Instrucciones breves de instalación:

1. Clona el repositorio:
   git clone https://github.com/cristopher-gomez-m/pruebaPhp.git
   cd pruebaPhp

2. Instala las dependencias:
   composer install


3. Configura la base de datos:
    - Crea un archivo .env en la raíz del proyecto con las siguientes variables:
       DB_HOST=127.0.0.1
       DB_PORT=3306
       DB_NAME=consultorio
       DB_USER=usuario
       DB_PASS=contraseña
    - Importa el archivo database.sql en tu servidor MySQL.

4. Inicia el servidor de desarrollo:
   php -S localhost:8000 -t public

5. Accede a la aplicación en tu navegador:
   http://localhost:8000

