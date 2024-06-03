<?php
session_start();
require_once '../config/db.php';
require_once '../models/User.php';

$action = $_GET['action'] ?? '';

switch ($action) {

    case 'login':
        $email = $_POST['email'];
        $password = $_POST['password'];
        $user = new User($conexion);
        $userData = $user->login($email, $password);

        if ($userData) {
            $_SESSION['user_id'] = $userData['usuario_id'];
            $_SESSION['user_name'] = $userData['nombre']; // Guardar el nombre del usuario en la sesión
            header('Location: ../views/contactos.php');
        } else {
            $_SESSION['mensaje'] = "Credenciales incorrectas. Por favor, inténtalo de nuevo.";
            header("Location: ../views/login.php");
            exit();
        }
        break;

    case 'register':
        $nombre = $_POST['nombre'];
        $email = $_POST['email'];
        $password = password_hash($_POST['password'], PASSWORD_BCRYPT);

        try {
            $user = new User($conexion);
            $user->register($nombre, $email, $password);
            $_SESSION['mensaje'] = "Usuario registrado exitosamente.";
            header('Location: ../views/login.php');
        } catch (PDOException $e) {
            if ($e->getCode() == 23000) { // Código de error para duplicados en MySQL
                $_SESSION['mensaje'] = "El correo electrónico ya está registrado.";
                header('Location: ../views/login.php');
            } else {
                $_SESSION['mensaje'] = "Error al registrar el usuario: " . $e->getMessage();
                header('Location: ../views/login.php');
            }
        }

        
        break;

    case 'logout':
        session_destroy();
        header('Location: ../views/login.php');
        break;
}
