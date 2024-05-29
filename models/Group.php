<?php
class Group {
    private $conexion;

    public function __construct($pdo) {
        $this->conexion = $pdo;
    }

    public function nuevoGrupo($data) {
        $stmt = $this->conexion->prepare("INSERT INTO creacion_grupo (usuario_id, nombre_grupo) VALUES (:usuario_id, :nombre_grupo)");
        $stmt->execute([
            'usuario_id' => $_SESSION['user_id'],
            'nombre_grupo' => $data['nombre_grupo']
        ]);
    }

    public function editarGrupo($groupId, $data) {
        $stmt = $this->conexion->prepare("UPDATE creacion_grupo SET nombre_grupo = :nombre_grupo WHERE creacion_grupo_id = :creacion_grupo_id");
        $stmt->execute([
            'nombre_grupo' => $data['nombre_grupo'],
            'creacion_grupo_id' => $groupId
        ]);
    }

    public function eliminarGrupo($groupId) {
        $stmt = $this->conexion->prepare("DELETE FROM creacion_grupo WHERE creacion_grupo_id = :creacion_grupo_id");
        $stmt->execute(['creacion_grupo_id' => $groupId]);
    }

    public function obtenerGruposPorUsuarioID($userId) {
        $stmt = $this->conexion->prepare("SELECT * FROM creacion_grupo WHERE usuario_id = :usuario_id");
        $stmt->execute(['usuario_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($groupId) {
        $stmt = $this->conexion->prepare('SELECT * FROM creacion_grupo WHERE creacion_grupo_id = :creacion_grupo_id');
        $stmt->execute(['creacion_grupo_id' => $groupId]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
}
