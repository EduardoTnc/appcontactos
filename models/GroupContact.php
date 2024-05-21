<?php
class GroupContact {
    private $pdo;

    public function __construct($pdo) {
        $this->pdo = $pdo;
    }

    public function addContactToGroup($contactId, $groupId) {
        $stmt = $this->pdo->prepare("INSERT INTO contacto_grupo (contacto_id, creacion_grupo_id) VALUES (:contacto_id, :creacion_grupo_id)");
        $stmt->execute([
            'contacto_id' => $contactId,
            'creacion_grupo_id' => $groupId
        ]);
    }

    public function removeContactFromGroup($contactId, $groupId) {
        $stmt = $this->pdo->prepare("DELETE FROM contacto_grupo WHERE contacto_id = :contacto_id AND creacion_grupo_id = :creacion_grupo_id");
        $stmt->execute([
            'contacto_id' => $contactId,
            'creacion_grupo_id' => $groupId
        ]);
    }

    public function getContactsByGroupId($groupId) {
        $stmt = $this->pdo->prepare("SELECT contactos.* FROM contactos
                                     JOIN contacto_grupo ON contactos.contacto_id = contacto_grupo.contacto_id
                                     WHERE contacto_grupo.creacion_grupo_id = :creacion_grupo_id");
        $stmt->execute(['creacion_grupo_id' => $groupId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
