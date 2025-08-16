# Citas Médicas

Este proyecto es una aplicación web sencilla para la gestión de citas médicas en un consultorio. Permite registrar, listar y eliminar citas, especificando el nombre del paciente, la especialidad y la fecha de la cita.

## Tecnologías utilizadas
- PHP 8+
- MySQL
- Composer (para gestión de dependencias)
- Bootstrap 5 (para la interfaz)

## Estructura del proyecto
- `public/`: Archivos públicos y punto de entrada (`index.php`)
- `src/`: Código fuente (controladores, modelos, servicios, repositorios, vistas)
- `database.sql`: Script para crear la base de datos y la tabla de citas
- `.env`: Variables de entorno para la conexión a la base de datos

## Instalación y ejecución

1. **Clona el repositorio**

```bash
git clone https://github.com/cristopher-gomez-m/pruebaPhp.git
cd citas-medicas
```

2. **Instala las dependencias con Composer**

Asegúrate de tener [Composer](https://getcomposer.org/) instalado.

```bash
composer install
```

3. **Configura el archivo `.env`**

Copia el archivo `.env.example` (si existe) o crea uno nuevo llamado `.env` en la raíz del proyecto con el siguiente contenido y tus propios datos:

```
DB_HOST=127.0.0.1
DB_PORT=3306
DB_NAME=consultorio
DB_USER=usuario
DB_PASS=contraseña
```

4. **Crea la base de datos**

Importa el archivo `database.sql` en tu servidor MySQL:

```bash
mysql -u tu_usuario -p < database.sql
```

5. **Inicia el servidor de desarrollo**

```bash
php -S localhost:8000 -t public
```

Luego abre [http://localhost:8000](http://localhost:8000) en tu navegador.

## Notas
- El archivo `.env` **no debe subirse al repositorio** (está en `.gitignore`).
- El sistema valida que la fecha de la cita no sea en el pasado.
- El nombre del paciente solo acepta letras.

## Arquitectura

El proyecto sigue una arquitectura inspirada en el patrón de capas, separando responsabilidades para facilitar el mantenimiento y la escalabilidad:

- **Controller**: Se encarga de recibir las peticiones del usuario y coordinar la lógica de la aplicación. En este proyecto, los controladores gestionan las vistas, pero también pueden ser adaptados fácilmente para manejar peticiones HTTP en una API (por ejemplo, devolviendo JSON en vez de vistas).
- **Service**: Contiene la lógica de negocio y validaciones. Aquí se valida, por ejemplo, que la fecha de la cita no sea en el pasado antes de guardar en la base de datos.
- **Repository**: Es responsable de interactuar directamente con la base de datos. Realiza operaciones CRUD y transforma los datos en instancias del modelo.
- **Model**: Representa la estructura de los datos (en este caso, una cita médica) y puede contener lógica relacionada con la entidad.

Esta separación permite que cada capa tenga una única responsabilidad y facilita la reutilización y pruebas de cada componente.

## Licencia
Este proyecto es solo para fines educativos.
