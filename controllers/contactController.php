<?php
require_once '../config/db.php';
require_once '../models/Contact.php';

$action = $_GET['action'] ?? '';

switch ($action) {
    case 'add':
        $contact = new Contact($pdo);
        $contact->add($_POST);
        header('Location: ../views/contacts/list.php');
        break;

    case 'edit':
        $contact = new Contact($pdo);
        $contact->edit($_POST['contact_id'], $_POST);
        header('Location: ../views/contacts/list.php');
        break;

    case 'delete':
        $contact = new Contact($pdo);
        $contact->delete($_POST['contact_id']);
        header('Location: ../views/contacts/list.php');
        break;
}

