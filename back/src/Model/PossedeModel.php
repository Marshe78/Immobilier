<?php
namespace App\Model;
use Core\Model\DefaultModel;

class PossedeModel extends DefaultModel {

    protected string $table = "possede";
    protected string $entity = "Possede";
    protected string $Id_table = "Id_bien";

    public function savePossede(array $possede){
        $stmt = "INSERT INTO $this->table 
        (Id_bien , Id_option, Possede) VALUES (:Id_bien , :Id_option, :Possede)";
        $prepare = $this->pdo->prepare($stmt);
        if ($prepare->execute($possede)){
            return $this->pdo->lastInsertId($this->table);
        }else {
            $this->jsonResponse("Erreur lors de l'ajout d'une option", 400);
        }
    }

    public function updatePossede(int $id, array $possede){
        $stmt = "UPDATE $this->table 
                SET Id_option = :Id_option,
                Possede = :Possede
                WHERE Id_bien = :Id_bien";
        $prepare = $this->pdo->prepare($stmt);
        $possede['Id_bien'] = $id;
        return $prepare->execute($possede);

    }  
}