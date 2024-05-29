<?php
require_once '../config/db.php';
require_once '../models/Group.php';

session_start();

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        $grupo = new Group($conexion);
        $grupo->nuevoGrupo($_POST);
        header('Location: ../views/contactos.php');
        break;

    case 'edit':
        $grupo = new Group($conexion);
        $grupo->editarGrupo($_POST['group_id'], $_POST);
        header('Location: ../views/contactos.php');
        break;

    case 'delete':
        $grupo = new Group($conexion);
        $grupo->eliminarGrupo($_POST['group_id']);
        header('Location: ../views/contactos.php');
        break;

    case 'get':
        $grupo = new Group($conexion);
        $grupoData = $grupo->getById($_GET['group_id']);
        $response['group'] = $grupoData;
        $response['success'] = true;
        break;
}

header('Content-Type: application/json');
echo json_encode($response);