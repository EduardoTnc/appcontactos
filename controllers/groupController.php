<?php
require_once '../config/db.php';
require_once '../models/Group.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        $group = new Group($conexion);
        $group->add($_POST);
        header('Location: ../views/groups/list.php');
        break;

    case 'edit':
        $group = new Group($conexion);
        $group->edit($_POST['group_id'], $_POST);
        header('Location: ../views/groups/list.php');
        break;
        
        case 'delete':
        $group = new Group($conexion);
        $group->delete($_POST['group_id']);
        header('Location: ../views/groups/list.php');
        break;
        }
      
        