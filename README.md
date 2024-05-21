# App Contactos

Este es un proyecto de gestión de contactos. Los usuarios pueden registrarse, iniciar sesión, y gestionar sus contactos y grupos.

## Estructura del Proyecto

- **config/db.php**: Configuración de la base de datos.
- **public/**: Archivos públicos como CSS, JS y el punto de entrada principal (`index.php`).
- **includes/**: Partes comunes como la cabecera, pie de página, barra de navegación y modales.
- **views/**: Vistas de la aplicación (login, register, contacts, groups, dashboard).
- **controllers/**: Controladores que manejan la lógica de la aplicación.
- **models/**: Modelos que interactúan con la base de datos.
- **helpers/**: Funciones de ayuda para sesiones, redirección y validación.
- **.htaccess**: Archivo de configuración de Apache.
- **README.md**: Documentación del proyecto.

## Instalación

1. Clonar el repositorio.
2. Crear una base de datos `contact_manager`.
3. Importar el archivo SQL para crear las tablas necesarias.
4. Configurar los detalles de la base de datos en `config/db.php`.
5. Ejecutar la aplicación en un servidor local.

## Uso

1. Registrarse en la aplicación.
2. Iniciar sesión con las credenciales.
3. Gestionar contactos y grupos desde el panel de control.

## Características

- Registro e inicio de sesión de usuarios.
- Gestión de contactos (agregar, editar, eliminar).
- Gestión de grupos de contactos.
- Interfaz intuitiva y fácil de usar.
