<?php
namespace App\Model;

use Core\Model\DefaultModel;

class UtilisateurModel extends DefaultModel {
    
    protected string $table = "Utilisateur";
    protected string $entity = "Utilisateur";
    protected string $Id_table = "Id_utilisateur";

    public function getUserByEmail($email){
        
        $email = htmlspecialchars($email);
        $stmt = "SELECT * FROM $this->table WHERE Email = '$email'";
        $query = $this->pdo->query($stmt, \PDO::FETCH_CLASS, "App\Entity\\$this->entity");

        return $query->fetch();
    }

    public function getUserById($id){
        
        $stmt = "SELECT * FROM $this->table WHERE Id_utilisateur = '$id'";
        $query = $this->pdo->query($stmt, \PDO::FETCH_CLASS, "App\Entity\\$this->entity");

        return $query->fetch();
    }

    public function saveUser($user){
         $stmt = "INSERT INTO $this->table 
         (Nom, Prenom, Email, Password, Role) 
         VALUES (:Nom, :Prenom, :Email, :Password, :Role)";
         $prepare = $this->pdo->prepare($stmt);
         if($prepare->execute($user)){
             return $this->pdo->lastInsertId($this->table);
         }else {
             return false;
         }
    }

    public function updateUser(int $id, array $user){
        $stmt = "UPDATE $this->table
                SET Nom = :Nom,
                Prenom = :Prenom,
                Email = :Email, 
                Role = :Role
                WHERE Id_utilisateur = :Id_utilisateur";
        
        $prepare = $this->pdo->prepare($stmt);
        $user['Id_utilisateur'] = $id;

        return $prepare->execute($user);
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