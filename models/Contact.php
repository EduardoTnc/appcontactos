<?php
class Contact {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function add($data) {
        $stmt = $this->pdo->prepare("INSERT INTO contactos (usuario_id, nombre, apellido, email, telefono) VALUES (:usuario_id, :nombre, :apellido, :email, :telefono)");
        $stmt->execute([
            'usuario_id' => $_SESSION['user_id'],
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'telefono' => $data['telefono']
        ]);
    }

    public function edit($contactId, $data) {
        $stmt = $this->pdo->prepare("UPDATE contactos SET nombre = :nombre, apellido = :apellido, email = :email, telefono = :telefono WHERE contacto_id = :contacto_id");
        $stmt->execute([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'contacto_id' => $contactId
        ]);
    }

    public function delete($contactId) {
        $stmt = $this->pdo->prepare("DELETE FROM contactos WHERE contacto_id = :contacto_id");
        $stmt->execute(['contacto_id' => $contactId]);
    }

    public function getAllByUserId($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM contactos WHERE usuario_id = :usuario_id");
        $stmt->execute(['usuario_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}

