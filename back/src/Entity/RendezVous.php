<?php

namespace App\Entity;

use JsonSerializable;
use OpenApi\Attributes as OA;

#[OA\Schema(title:"RendezVous")]
class RendezVous implements JsonSerializable
{
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    private int $Id_rdv;
    #[OA\Property(
        type: "datetime",
        nullable: false,
    )]
    private string $Date_rdv;
    #[OA\Property(
        type: "boolean",
        nullable: false,
    )]
    private string $Annulation;
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    private string $Description_rdv;
    #[OA\Property(
        type: "integer",
        nullable: true,
    )]
    private ?int $Id_utilisateur;
    

    /**
     * Get the value of Id_rdv
     *
     * @return int
     */
    public function getIdRdv(): int
    {
        return $this->Id_rdv;
    }

    /**
     * Set the value of Id_rdv
     *
     * @param int $Id_rdv
     *
     * @return self
     */
    public function setIdRdv(int $Id_rdv): self
    {
        $this->Id_rdv = $Id_rdv;

        return $this;
    }

    /**
     * Get the value of Date_rdv
     *
     * @return string
     */
    public function getDateRdv(): string
    {
        return $this->Date_rdv;
    }

    /**
     * Set the value of Date_rdv
     *
     * @param string $Date_rdv
     *
     * @return self
     */
    public function setDateRdv(string $Date_rdv): self
    {
        $this->Date_rdv = $Date_rdv;

        return $this;
    }

    /**
     * Get the value of Annulation
     *
     * @return string
     */
    public function getAnnulation(): string
    {
        return $this->Annulation;
    }

    /**
     * Set the value of Annulation
     *
     * @param string $Annulation
     *
     * @return self
     */
    public function setAnnulation(string $Annulation): self
    {
        $this->Annulation = $Annulation;

        return $this;
    }

    /**
     * Get the value of Description_rdv
     *
     * @return string
     */
    public function getDescriptionRdv(): string
    {
        return $this->Description_rdv;
    }

    /**
     * Set the value of Description_rdv
     *
     * @param string $Description_rdv
     *
     * @return self
     */
    public function setDescriptionRdv(string $Description_rdv): self
    {
        $this->Description_rdv = $Description_rdv;

        return $this;
    }

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
     * Set the value of Id_utilisateur
     *
     * @param int $Id_utilisateur
     *
     * @return self
     */
    public function setIdUtilisateur(int $Id_utilisateur): self
    {
        $this->Id_utilisateur = $Id_utilisateur;

        return $this;
    }

    
    public function JsonSerialize(): mixed
    {
        return [
            "Id_rdv" => $this->Id_rdv,
            "Date_rdv" => $this->Date_rdv,
            "Annulation" => $this->Annulation,
            "Description_rdv" => $this->Description_rdv,
            "Id_utilisateur" => $this->Id_utilisateur,
        ];
    }

}