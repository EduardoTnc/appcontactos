<?php
require_once '../config/db.php';
require_once '../models/Contact.php';

session_start();

$action = $_GET['action'] ?? '';

$response = ['success' => false];

switch ($action) {
    case 'add':
        $contact = new Contact($conexion);

        // Manejar la subida de archivos
        $fotoPerfil = null;
        if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
            $fotoPerfil = 'fotos/' . basename($_FILES['foto_perfil']['name']);
            move_uploaded_file($_FILES['foto_perfil']['tmp_name'], '../views/' . $fotoPerfil);
        }

        // Agregar el contacto con la foto de perfil
        $contact->add($_POST, $fotoPerfil);
        echo json_encode(['success' => true]);
        header('Location: ../views/contactos.php');
        break;

    case 'edit':
        $contact = new Contact($conexion);
        
         // Manejar la subida de archivos
        $fotoPerfil = null;
        if (isset($_FILES['foto_perfil']) && $_FILES['foto_perfil']['error'] === UPLOAD_ERR_OK) {
            $fotoPerfil = 'fotos/' . basename($_FILES['foto_perfil']['name']);
            move_uploaded_file($_FILES['foto_perfil']['tmp_name'], '../views/' . $fotoPerfil);
        }

        // Editar el contacto con la foto de perfil
        $contact->edit($_POST['contact_id'], $_POST, $fotoPerfil);
        echo json_encode(['success' => true]);
        header('Location: ../views/contactos.php');
        break;

    case 'delete':
        $contact = new Contact($conexion);
        $contact->delete($_POST['contact_id']);
        $response['success'] = true;
        header('Location: ../views/contactos.php');
        break;

    case 'list':
        $contact = new Contact($conexion);
        $contacts = $contact->obtenerContactos($_SESSION['user_id']);
        $response['contacts'] = $contacts;
        $response['success'] = true;
        break;

    // Obtener un contacto por su ID (Para cargarlo en el modal de edición)
    case 'get':
        $contact = new Contact($conexion);
        $contactData = $contact->getById($_GET['contact_id']);
        $response['contact'] = $contactData;
        $response['success'] = true;
        break;
}

header('Content-Type: application/json');
echo json_encode($response);
