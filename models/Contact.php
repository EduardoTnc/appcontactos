<?php


class Contact
{
    private $pdo;

    public function __construct($pdo)
    {
        $this->pdo = $pdo;
    }

    public function add($data)
    {
        $stmt = $this->pdo->prepare("INSERT INTO contactos (usuario_id, nombre, apellido, email, telefono, direccion, fecha_nacimiento, foto_perfil, etiqueta) 
                                    VALUES (:usuario_id, :nombre, :apellido, :email, :telefono, :direccion, :fecha_nacimiento, :foto_perfil, :etiqueta)");
        $stmt->execute([
            'usuario_id' => $_SESSION['user_id'],
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'foto_perfil' => $data['foto_perfil'],
            'etiqueta' => $data['etiqueta'],
        ]);
    }

    public function edit($contactId, $data)
    {
        $stmt = $this->pdo->prepare("UPDATE contactos SET nombre = :nombre, apellido = :apellido, email = :email, telefono = :telefono WHERE contacto_id = :contacto_id");
        $stmt->execute([
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'contacto_id' => $contactId
        ]);
    }

    public function delete($contactId)
    {
        $stmt = $this->pdo->prepare("DELETE FROM contactos WHERE contacto_id = :contacto_id");
        $stmt->execute(['contacto_id' => $contactId]);
    }

    // Obtener todos los contactos de un usuario
    public function getAllByUserId($userId)
    {
        $stmt = $this->pdo->prepare("SELECT * FROM contactos WHERE usuario_id = :usuario_id");
        $stmt->execute(['usuario_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un contacto por su ID
    public function getById($contactId)
    {
        $stmt = $this->pdo->prepare('SELECT * FROM contactos WHERE contacto_id = :contacto_id');
        $stmt->execute(['contacto_id' => $contactId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
