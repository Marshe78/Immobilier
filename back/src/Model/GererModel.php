<?php

namespace App\Model;

use Core\Model\DefaultModel;

/**
 * Gerez 
 */
final class GererModel extends DefaultModel
{
    protected string $table = "Gerer";
    protected string $entity = "Gerer";
    protected string $Id_table = "Id_utilisateur";

    public function saveGerer($id, array $gerer){
        $stmt = "INSERT INTO $this->table 
        (Id_utilisateur, Id_bien) VALUES (:Id_utilisateur, :Id_bien)";
        $prepare = $this->pdo->prepare($stmt);
        $prepare->bindParam('Id_utilisateur', $id);
        $prepare->bindParam('Id_bien', $_POST['Id_bien']);
        if ($prepare->execute()){
            return $this->pdo->lastInsertId($this->table);
        }else {
            $this->jsonResponse("Erreur lors de l'ajout d'une gérance", 400);
        }
    }

    public function findByUser($id) {
        
    }

    
    public function updateGerer(int $id, array $gerer){
        $stmt = "UPDATE $this->table 
                SET Id_utilisateur = :Id_utilisateur,
                Id_bien = :Id_bien
                WHERE Id_bien = :Id_bien";
        $prepare = $this->pdo->prepare($stmt);
        $gerer['Id_bien'] = $id;
        return $prepare->execute($gerer);

    }  
  /*  public function updateGerer(int $id, array $optionBien){

        $stmt = "UPDATE $this->table 
                SET Nom = :Nom
                WHERE Id_option = :Id_option";
        $prepare = $this->pdo->prepare($stmt);
        //$optionBien['Id_option'] = $id;
        $prepare->bindParam(':Id_option', $id);
        $e = $optionBien["Nom"];
        $prepare->bindParam(':Nom', $e);
        return $prepare->execute();

    }  */
}