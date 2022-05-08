<?php
namespace App\Model;

use Core\Model\DefaultModel;

class OptionBienModel extends DefaultModel {
    
    protected string $table = "option_bien";
    protected string $entity = "Option_bien";
    protected string $Id_table = "Id_option";

    public function saveOptionBien(array $optionBien){
        $stmt = "INSERT INTO $this->table 
        (Nom) VALUES (:Nom)";
        $prepare = $this->pdo->prepare($stmt);
        if ($prepare->execute($optionBien)){
            return $this->pdo->lastInsertId($this->table);
        }else {
            $this->jsonResponse("Erreur lors de l'ajout d'une option", 400);
        }
    }

    public function updateOptionBien(int $id, array $optionBien){

        $stmt = "UPDATE $this->table 
                SET Nom = :Nom
                WHERE Id_option = :Id_option";
        $prepare = $this->pdo->prepare($stmt);
        //$optionBien['Id_option'] = $id;
        $prepare->bindParam(':Id_option', $id);
        $e = $optionBien["Nom"];
        $prepare->bindParam(':Nom', $e);
        return $prepare->execute();

    }  

    /**
     * Get the value of Id_table
     *
     * @return string
     */
    public function getIdTable(): string
    {
        return $this->Id_table;
    }
}