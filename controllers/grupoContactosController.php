<?php
// groupContactController.php

require_once '../config/db.php';
require_once '../models/GroupContact.php';

// Verificar si se recibieron los datos necesarios
if (isset($_POST['contacto_id']) && isset($_POST['grupo_id'])) {
    $contactoID = $_POST['contacto_id'];
    $grupoID = $_POST['grupo_id'];

    // Crear una instancia del modelo GroupContact
    $groupContact = new GroupContact($conexion);

    // Agregar el contacto al grupo
    $groupContact->agregrarContactoAlAgrupo($contactoID, $grupoID);

    // Redirigir de vuelta a la página de contactos
    header('Location: ../views/contactos.php');
    exit();
}