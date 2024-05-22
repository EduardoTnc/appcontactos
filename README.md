# App Contactos

Este es un proyecto de gestión de contactos. Los usuarios pueden registrarse, iniciar sesión, y gestionar sus contactos y grupos.

## Estructura del Proyecto

- **config/db.php**: Configuración de la base de datos.
- **views/**: Vistas de la aplicación (login-registro, contactos y grupos).
- **controllers/**: Controladores que manejan la lógica de la aplicación.
- **models/**: Modelos que interactúan con la base de datos.
- **helpers/**: Funciones de ayuda para sesiones, redirección y validación.
- **README.md**: Documentación del proyecto.

## Instalación

1. Clonar el repositorio.
2. Importar el archivo SQL para crear la base de datos. (Si te sale algún error crea manualmente la DB con el nombre 'app-contactos' y ejecuta el archivo 'sql-tablas.sql' para crear las tablas.)
3. Configurar los detalles de la base de datos en `config/db.php`.
4. Ejecutar la aplicación en un servidor local.

## Uso

1. Registrarse en la aplicación.
2. Iniciar sesión con las credenciales.
3. Gestionar contactos y grupos desde el panel de control.

## Características

- Registro e inicio de sesión de usuarios.
- Gestión de contactos (agregar, editar, eliminar).
- Gestión de grupos de contactos.
- Interfaz intuitiva y fácil de usar.
