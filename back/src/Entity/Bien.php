<?php
namespace App\Entity;

use JsonSerializable;
use OpenApi\Attributes as OA;

#[OA\Schema(title:"Bien")]
class Bien implements JsonSerializable {
    
    #[OA\Property(
        type: "integer",
        nullable: false,
    )]
    private int $Id_bien;
    #[OA\Property(
        type: "string",
        nullable: true,
    )]
    private string $Image_bien;
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    private string $Adresse;
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    private string $Ville;
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    private string $Type_bien;
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    private string $Proprietaire;
    #[OA\Property(
        type: "integer",
        nullable: false,
    )]
    private int $Superficie;
    #[OA\Property(
        type: "integer",
        nullable: false,
    )]
    private int $NbPiece;
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    private string $Prix;
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    private string $Paiement;
    #[OA\Property(
        type: "integer",
        nullable: false,
    )]
    private int $Status_bien;

    

    /**
     * Get the value of Id_bien
     *
     * @return int
     */
    public function getIdBien(): int
    {
        return $this->Id_bien;
    }

    /**
     * Get the value of Image_bien
     *
     * @return string
     */
    public function getImageBien(): string
    {
        return $this->Image_bien;
    }

    /**
     * Set the value of Image_bien
     *
     * @param string $Image_bien
     *
     * @return self
     */
    public function setImageBien(string $Image_bien): self
    {
        $this->Image_bien = $Image_bien;

        return $this;
    }

    /**
     * Get the value of Adresse
     *
     * @return string
     */
    public function getAdresse(): string
    {
        return $this->Adresse;
    }

    /**
     * Set the value of Adresse
     *
     * @param string $Adresse
     *
     * @return self
     */
    public function setAdresse(string $Adresse): self
    {
        $this->Adresse = $Adresse;

        return $this;
    }

    /**
     * Get the value of Ville
     *
     * @return string
     */
    public function getVille(): string
    {
        return $this->Ville;
    }

    /**
     * Set the value of Ville
     *
     * @param string $Ville
     *
     * @return self
     */
    public function setVille(string $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    /**
     * Get the value of Type_bien
     *
     * @return string
     */
    public function getTypeBien(): string
    {
        return $this->Type_bien;
    }

    /**
     * Set the value of Type_bien
     *
     * @param string $Type_bien
     *
     * @return self
     */
    public function setTypeBien(string $Type_bien): self
    {
        $this->Type_bien = $Type_bien;

        return $this;
    }

    /**
     * Get the value of Proprietaire
     *
     * @return string
     */
    public function getProprietaire(): string
    {
        return $this->Proprietaire;
    }

    /**
     * Set the value of Proprietaire
     *
     * @param string $Proprietaire
     *
     * @return self
     */
    public function setProprietaire(string $Proprietaire): self
    {
        $this->Proprietaire = $Proprietaire;

        return $this;
    }

    /**
     * Get the value of Superficie
     *
     * @return int
     */
    public function getSuperficie(): int
    {
        return $this->Superficie;
    }

    /**
     * Set the value of Superficie
     *
     * @param int $Superficie
     *
     * @return self
     */
    public function setSuperficie(int $Superficie): self
    {
        $this->Superficie = $Superficie;

        return $this;
    }

    /**
     * Get the value of NbPiece
     *
     * @return int
     */
    public function getNbPiece(): int
    {
        return $this->NbPiece;
    }

    /**
     * Set the value of NbPiece
     *
     * @param int $NbPiece
     *
     * @return self
     */
    public function setNbPiece(int $NbPiece): self
    {
        $this->NbPiece = $NbPiece;

        return $this;
    }

    /**
     * Get the value of Prix
     *
     * @return string
     */
    public function getPrix(): string
    {
        return $this->Prix;
    }

    /**
     * Set the value of Prix
     *
     * @param string $Prix
     *
     * @return self
     */
    public function setPrix(string $Prix): self
    {
        $this->Prix = $Prix;

        return $this;
    }

    /**
     * Get the value of Paiement
     *
     * @return string
     */
    public function getPaiement(): string
    {
        return $this->Paiement;
    }

    /**
     * Set the value of Paiement
     *
     * @param string $Paiement
     *
     * @return self
     */
    public function setPaiement(string $Paiement): self
    {
        $this->Paiement = $Paiement;

        return $this;
    }

    /**
     * Get the value of Status_bien
     *
     * @return int
     */
    public function getStatusBien(): int
    {
        return $this->Status_bien;
    }

    /**
     * Set the value of Status_bien
     *
     * @param int $Status_bien
     *
     * @return self
     */
    public function setStatusBien(int $Status_bien): self
    {
        $this->Status_bien = $Status_bien;

        return $this;
    }

    public function JsonSerialize(): mixed
    {
        return [
            "Id_bien" => $this->Id_bien,
            "Image_bien" => $this->Image_bien,
            "Adresse" => $this->Adresse,
            "Ville" => $this->Ville,
            "Type_bien" => $this->Type_bien,
            "Proprietaire" => $this->Proprietaire,
            "Superficie"=> $this->Superficie,
            "NbPiece"=> $this->NbPiece,
            "Prix"=> $this->Prix,
            "Paiement"=> $this->Paiement,
            "Status_bien"=> $this->Status_bien
        ];
    }
}