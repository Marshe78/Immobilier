<?php
namespace App\Model;
use Core\Model\DefaultModel;

class AttribuerModel extends DefaultModel {

    protected string $table = "attribuer";
    protected string $entity = "Attribuer";

    public function saveAttribuer(array $attribuer){
        $stmt = "INSERT INTO $this->table 
        (Id_bien , Id_rdv) VALUES (:Id_bien , :Id_rdv)";
        $prepare = $this->pdo->prepare($stmt);
        if ($prepare->execute($attribuer)){
            return $this->pdo->lastInsertId($this->table);
        }else {
            $this->jsonResponse("Erreur lors de l'ajout d'une option", 400);
        }
    }

    public function updateAttribuer(int $id, array $attribuer){
        $stmt = "UPDATE $this->table 
                SET Id_bien = :Id_bien,
                WHERE Id_rdv = :Id_rdv";
        $prepare = $this->pdo->prepare($stmt);
        $attribuer['Id_rdv'] = $id;
        return $prepare->execute($attribuer);

    }  
}