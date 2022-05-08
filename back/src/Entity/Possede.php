<?php
namespace App\Entity;
use JsonSerializable;
use OpenApi\Attributes as OA;

#[OA\Schema(title:"Possede")]
class Possede implements JsonSerializable {
    #[OA\Property(
        type: "integer",
        nullable: false,
    )]
    private int $Id_bien;
    #[OA\Property(
        type: "integer",
        nullable: false,
    )]
    private int $Id_option;
    #[OA\Property(
        type: "boolean",
        nullable: false,
    )]
    private bool $Possede;

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
     * Set the value of Id_option
     *
     * @param int $Id_option
     *
     * @return self
     */
    public function setIdOption(int $Id_option): self
    {
        $this->Id_option = $Id_option;

        return $this;
    }

    /**
     * Get the value of Possede
     *
     * @return bool
     */
    public function getPossede(): bool
    {
        return $this->Possede;
    }

    /**
     * Set the value of Possede
     *
     * @param bool $Possede
     *
     * @return self
     */
    public function setPossede(bool $Possede): self
    {
        $this->Possede = $Possede;

        return $this;
    }


    public function JsonSerialize():mixed 
    {
        return [
            "Id_bien" => $this->Id_bien,
            "Id_option" => $this->Id_option,
            "Possede" => $this->Possede
        ];
    }
}