<?php
require_once '../config/db.php';
require_once '../models/User.php';

class UserController {
    private $userModel;

    public function __construct($pdo) {
        $this->userModel = new User($pdo);
    }

    public function getUserById($userId) {
        return $this->userModel->getById($userId);
    }
}

