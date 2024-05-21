<?php
class User {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function register($nombre, $email, $password) {
        $stmt = $this->pdo->prepare("INSERT INTO usuarios (nombre, email, contrasenia) VALUES (:nombre, :email, :contrasenia)");
        $stmt->execute(['nombre' => $nombre, 'email' => $email, 'contrasenia' => $password]);
    }

    public function login($email, $password) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE email = :email");
        $stmt->execute(['email' => $email]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user && password_verify($password, $user['contrasenia'])) {
            return $user;
        }

        return false;
    }

    public function getById($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM usuarios WHERE usuario_id = :usuario_id");
        $stmt->execute(['usuario_id' => $userId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}