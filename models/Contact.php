<?php


class Contact
{
    private $conexion;

    public function __construct($pdo)
    {
        $this->conexion = $pdo;
    }

    public function add($data, $fotoPerfil)
    {
        $stmt = $this->conexion->prepare("INSERT INTO contactos (usuario_id, nombre, apellido, email, telefono, direccion, fecha_nacimiento, foto_perfil, etiqueta) 
                                    VALUES (:usuario_id, :nombre, :apellido, :email, :telefono, :direccion, :fecha_nacimiento, :foto_perfil, :etiqueta)");
        $stmt->execute([
            'usuario_id' => $_SESSION['user_id'],
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'foto_perfil' => $fotoPerfil,
            'etiqueta' => $data['etiqueta'],
        ]);
    }

    public function edit($contactId, $data, $fotoPerfil)
    {
        // Construir la consulta de actualización dinámicamente
        $query = "UPDATE contactos SET nombre = :nombre, apellido = :apellido, email = :email, telefono = :telefono, direccion = :direccion, fecha_nacimiento = :fecha_nacimiento, etiqueta = :etiqueta";
        $params = [
            'nombre' => $data['nombre'],
            'apellido' => $data['apellido'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'fecha_nacimiento' => $data['fecha_nacimiento'],
            'etiqueta' => $data['etiqueta'],
            'contacto_id' => $contactId
        ];

        if ($fotoPerfil) {
            $query .= ", foto_perfil = :foto_perfil";
            $params['foto_perfil'] = $fotoPerfil;
        }

        $query .= " WHERE contacto_id = :contacto_id";
        $stmt = $this->conexion->prepare($query);
        $stmt->execute($params);
    }

    public function delete($contactId)
    {
        $stmt = $this->conexion->prepare("DELETE FROM contactos WHERE contacto_id = :contacto_id");
        $stmt->execute(['contacto_id' => $contactId]);
    }

    // Obtener todos los contactos de un usuario
    public function obtenerContactos($usuarioID)
    {
        $stmt = $this->conexion->prepare("SELECT * FROM contactos WHERE usuario_id = :usuario_id");
        $stmt->execute(['usuario_id' => $usuarioID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Obtener un contacto por su ID
    public function getById($contactId)
    {
        $stmt = $this->conexion->prepare('SELECT * FROM contactos WHERE contacto_id = :contacto_id');
        $stmt->execute(['contacto_id' => $contactId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function obtenerTotalContactos($usuarioID) {
        $stmt = $this->conexion->prepare("SELECT COUNT(*) as total FROM contactos WHERE usuario_id = :usuario_id");
        $stmt->execute(['usuario_id' => $usuarioID]);
        $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
        return $resultado['total'];
    }

}
