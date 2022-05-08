<?php

namespace App\Model;

use App\Entity\Utilisateur;
use Core\Model\DefaultModel;
use Exception;
use PHPMailer\PHPMailer\PHPMailer;

/**
 * Tous les rendez vous
 */
class RendezVousModel extends DefaultModel
{
    protected string $table = "rendez_vous";
    protected string $entity = "RendezVous";
    protected string $Id_table = "Id_rdv";

    /**
     * Enregistrer un rendez vous 
     */
    public function saveRdv (array $rdv): ?int
    {
        $stmt = "INSERT INTO $this->table (Description_rdv,Date_rdv,Annulation) 
        VALUES (:Description_rdv, 
                :Date_rdv,
                :Annulation
                )";
        $prepare = $this->pdo->prepare($stmt);

        if ($prepare->execute($rdv)) {
            // récupère le dernier id inséré en BDD
            return $this->pdo->lastInsertId($this->table);
        } else {
            $this->jsonResponse("Erreur lors de l'ajout d'un rendez vous", 400);
        }
    }

    /**
     * Mise à jour d'un rendez vous
     */
    public function updateRdv(int $id, array $rdv)
    {  
        
        $stmt = "UPDATE $this->table 
                SET Description_rdv = :Description_rdv, 
                Date_rdv = :Date_rdv,
                Annulation = :Annulation,
                Id_utilisateur = :Id_utilisateur
                WHERE Id_rdv = :Id_rdv";
        
        $prepare = $this->pdo->prepare($stmt);
        $rdv['Id_rdv'] = $id;
        return $prepare->execute($rdv);
    }

    public function getRdvById(int $id)
    {
        try {
            $stmt = "SELECT * FROM $this->table WHERE Id_utilisateur = $id";
            $query = $this->pdo->query($stmt, \PDO::FETCH_CLASS, "App\Entity\\$this->entity");
            return $query->fetchAll();
        } catch (\PDOException $e) {
            $this->jsonResponse($e->getMessage(), 400);
        }
    }

    public function sendMail($rdv){

        $user = new UtilisateurModel();
        $userFind = $user->getUserById($rdv['Id_utilisateur']);
      
        if(isset($userFind)){
            $date = $rdv['Date_rdv'];
            $to      = $userFind->Email;
            $subject = 'Rendez vous pris !';
            $message = 'Bonjour, votre rendez vous est prit le '.$date;
            $headers = 'From: gerant_agence@wanadoo.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
       
            mail($to, $subject, $message, $headers);
        }else{
            Throw new Exception('Utilisateur introuvable');
        }
        
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
