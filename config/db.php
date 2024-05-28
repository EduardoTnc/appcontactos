<?php

// Definir la URL base de la aplicación
define('APP_URL', 'http://localhost/appcontactos/');

// Definir las credenciales de acceso a la base de datos
$host = 'localhost';
$dbname = 'app-contactos';
$username = 'root';
$password = '';

try {
    $conexion = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conexion->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Error al conectarse a la Base de Datos: " . $e->getMessage());
}
