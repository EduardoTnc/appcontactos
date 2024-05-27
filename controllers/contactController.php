<?php
require_once '../config/db.php';
require_once '../models/Contact.php';

session_start();

$action = $_GET['action'] ?? '';

$response = ['success' => false];

switch ($action) {
    case 'add':
        $contact = new Contact($pdo);
        $contact->add($_POST);
        $response['success'] = true;
        header('Location: ../views/contactos.php');
        break;

    case 'edit':
        $contact = new Contact($pdo);
        $contact->edit($_POST['contact_id'], $_POST);
        $response['success'] = true;
        break;

    case 'delete':
        $contact = new Contact($pdo);
        $contact->delete($_POST['contact_id']);
        $response['success'] = true;
        break;

    case 'list':
        $contact = new Contact($pdo);
        $contacts = $contact->getAllByUserId($_SESSION['user_id']);
        $response['contacts'] = $contacts;
        $response['success'] = true;
        break;

    case 'get':
        $contact = new Contact($pdo);
        $contactData = $contact->getById($_GET['contact_id']);
        $response['contact'] = $contactData;
        $response['success'] = true;
        break;
}

header('Content-Type: application/json');
echo json_encode($response);
