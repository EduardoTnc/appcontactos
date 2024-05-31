<?php
class GroupContact
{
    private $pdo;

    public function __construct($conexion)
    {
        $this->pdo = $conexion;
    }

    public function agregrarContactoAlAgrupo($contactoID, $grupoID)
    {
        $stmt = $this->pdo->prepare("INSERT INTO contacto_grupo (contacto_id, creacion_grupo_id) VALUES (:contacto_id, :creacion_grupo_id)");
        $stmt->execute([
            'contacto_id' => $contactoID,
            'creacion_grupo_id' => $grupoID
        ]);
    }

    public function removerContactoDelGrupo($contactoID, $grupoID)
    {
        $stmt = $this->pdo->prepare("DELETE FROM contacto_grupo WHERE contacto_id = :contacto_id AND creacion_grupo_id = :creacion_grupo_id");
        $stmt->execute([
            'contacto_id' => $contactoID,
            'creacion_grupo_id' => $grupoID
        ]);
    }

    public function obtenerContactosPorGrupoID($grupoID)
    {
        $stmt = $this->pdo->prepare("SELECT contactos.* FROM contactos
                                     JOIN contacto_grupo ON contactos.contacto_id = contacto_grupo.contacto_id
                                     WHERE contacto_grupo.creacion_grupo_id = :creacion_grupo_id");
        $stmt->execute(['creacion_grupo_id' => $grupoID]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
