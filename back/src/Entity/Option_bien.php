<?php
namespace App\Entity;

use JsonSerializable;
use OpenApi\Attributes as OA;

#[OA\Schema(title:"Option_bien")]
class Option_bien implements JsonSerializable {

    #[OA\Property(
        type: "integer",
        nullable: false,
    )]
    private int $Id_option;
    #[OA\Property(
        type: "string",
        nullable: false,
    )]
    private string $Nom;

    /**
     * Get the value of Id_option
     *
     * @return int
     */
    public function getIdOption(): int
    {
        return $this->Id_option;
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

    public function JsonSerialize(): mixed
    {
        return [
            "Id_option" => $this->Id_option,
            "Nom" => $this->Nom
        ];
    }
}