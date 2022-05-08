<?php

namespace App\Entity;

use JsonSerializable;
use OpenApi\Attributes as OA;

#[OA\Schema(title:"Gerer")]
class Gerer implements JsonSerializable
{

    #[OA\Property(
        type: "integer",
        nullable: false,
    )]
    private int $Id_utilisateur;

    #[OA\Property(
        type: "integer",
        nullable: false,
    )]
    public int $Id_bien;

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
     * Set the value of Id_bien
     *
     * @param int $Id_bien
     *
     * @return self
     */
    public function setIdBien(int $Id_bien): self
    {
        $this->Id_bien = $Id_bien;

        return $this;
    }
    
    public function JsonSerialize(): mixed
    {
        return [
            "Id_utilisateur" => $this->Id_utilisateur,
            "Id_bien" => $this->Id_bien
        ];
    }

}