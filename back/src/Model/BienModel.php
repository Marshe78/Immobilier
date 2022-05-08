<?php
namespace App\Model;
use Core\Model\DefaultModel;

class BienModel extends DefaultModel {

    protected string $table = "Bien";
    protected string $entity = "Bien";
    protected string $Id_table = "Id_bien";


    public function saveBien(array $bien){

        $bien['Status_bien'] = (int)$bien['Status_bien'];
        $bien['Superficie'] = (int)$bien['Superficie'];
        $bien['NbPiece'] = (int)$bien['NbPiece'];

        $stmt = "INSERT INTO $this->table 
        (Image_bien, Adresse, Ville, Type_bien, Proprietaire, 
        Superficie, NbPiece, Prix, Paiement, Status_bien) 
        VALUES ( :Image_bien, :Adresse, :Ville, :Type_bien, :Proprietaire, 
        :Superficie, :NbPiece, :Prix, :Paiement, :Status_bien)";
        $prepare = $this->pdo->prepare($stmt);
        if ($prepare->execute($bien)){
            return $this->pdo->lastInsertId($this->table);
        }else {
            $this->jsonResponse("Erreur lors de l'ajout du bien", 400);
        }
    }

    public function updateBien(int $id, array $bien){
        $stmt = "UPDATE $this->table 
                SET Image_bien = :Image_bien,
                    Adresse = :Adresse,
                    Ville = :Ville,
                    Type_bien = :Type_bien,
                    Proprietaire = :Proprietaire,
                    Superficie = :Superficie,
                    NbPiece = :NbPiece,
                    Prix = :Prix,
                    Paiement = :Paiement,
                    Status_bien = :Status_bien
                WHERE Id_bien = :Id_bien";
        $prepare = $this->pdo->prepare($stmt);
        $bien['Id_bien'] = $id;
       
        return $prepare->execute($bien);

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