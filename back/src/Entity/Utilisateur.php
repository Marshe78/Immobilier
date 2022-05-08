<?php
namespace App\Entity;

use Core\Entity\DefaultEntity;
use OpenApi\Attributes as OA;

#[OA\Schema(title:"Categorie")]
class Utilisateur extends DefaultEntity {

    #[OA\Property(
        type: "integer",
        nullable: false,
    )]
    private int $Id_utilisateur;
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    private string $Nom;
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    private string $Prenom;
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    public string $Email;
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    private string $Password;
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    private String $Role;

    /**
     * Get the value of Id_utilisateur
     *
     * @return int
     */
    public function getIdUtilisateur(): int
    {
        return $this->Id_utilisateur;
    }

    /**
     * Get the value of Nom
     *
     * @return string
     */
    public function getNom(): string
    {
        return $this->Nom;
    }

    /**
     * Set the value of Nom
     *
     * @param string $Nom
     *
     * @return self
     */
    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    /**
     * Get the value of Prenom
     *
     * @return string
     */
    public function getPrenom(): string
    {
        return $this->Prenom;
    }

    /**
     * Set the value of Prenom
     *
     * @param string $Prenom
     *
     * @return self
     */
    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    /**
     * Get the value of Email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->Email;
    }

    /**
     * Set the value of Email
     *
     * @param string $Email
     *
     * @return self
     */
    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    /**
     * Get the value of Password
     *
     * @return string
     */
    public function getPassword(): string
    {
        return $this->Password;
    }

    /**
     * Set the value of Password
     *
     * @param string $Password
     *
     * @return self
     */
    public function setPassword(string $Password): self
    {
        $this->Password = $Password;

        return $this;
    }

    /**
     * Get the value of Role
     *
     * @return String
     */
    public function getRole(): String
    {
        return $this->Role;
    }

    /**
     * Set the value of Role
     *
     * @param String $Role
     *
     * @return self
     */
    public function setRole(String $Role): self
    {
        $this->Role = $Role;

        return $this;
    }

    public function JsonSerialize(): array
    {
        return [
            "Id_utilisateur" => $this->Id_utilisateur,
            "Nom" => $this->Nom,
            "Prenom" => $this->Prenom,
            "Email" => $this->Email,
            "Role" => $this->Role,
        ];
    }

}