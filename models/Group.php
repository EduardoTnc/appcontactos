<?php
class Group {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function add($data) {
        $stmt = $this->pdo->prepare("INSERT INTO creacion_grupo (usuario_id, nombre_grupo) VALUES (:usuario_id, :nombre_grupo)");
        $stmt->execute([
            'usuario_id' => $_SESSION['user_id'],
            'nombre_grupo' => $data['nombre_grupo']
        ]);
    }

    public function edit($groupId, $data) {
        $stmt = $this->pdo->prepare("UPDATE creacion_grupo SET nombre_grupo = :nombre_grupo WHERE creacion_grupo_id = :creacion_grupo_id");
        $stmt->execute([
            'nombre_grupo' => $data['nombre_grupo'],
            'creacion_grupo_id' => $groupId
        ]);
    }

    public function delete($groupId) {
        $stmt = $this->pdo->prepare("DELETE FROM creacion_grupo WHERE creacion_grupo_id = :creacion_grupo_id");
        $stmt->execute(['creacion_grupo_id' => $groupId]);
    }

    public function getAllByUserId($userId) {
        $stmt = $this->pdo->prepare("SELECT * FROM creacion_grupo WHERE usuario_id = :usuario_id");
        $stmt->execute(['usuario_id' => $userId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
