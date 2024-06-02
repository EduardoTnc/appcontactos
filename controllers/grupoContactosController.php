<?php
// groupContactController.php

require_once '../config/db.php';
require_once '../models/GroupContact.php';

session_start();
$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':

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
        }
        break;

    case 'remove':
        $contactoID = $_POST['contacto_id'];
        $grupoID = $_POST['grupo_id'];

        // Crear una instancia del modelo GroupContact
        $groupContact = new GroupContact($conexion);

        // Eliminar el contacto del grupo
        $groupContact->removerContactoDelGrupo($contactoID, $grupoID);

        // Redirigir de vuelta a la página de contactos
        header('Location: ../views/contactos.php');
        break;
}
