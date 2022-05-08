<?php
namespace App\Entity;
use JsonSerializable;
use OpenApi\Attributes as OA;

#[OA\Schema(title:"Attribuer")]
class Attribuer implements JsonSerializable {

    #[OA\Property(
        type: "integer",
        nullable: false,
    )]
    private int $Id_bien;
    #[OA\Property(
        type: "integer",
        nullable: false,
    )]
    private int $Id_rdv;

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


    public function JsonSerialize():mixed 
    {
        return [
            "Id_bien" => $this->Id_bien,
            "Id_rdv" => $this->Id_option
        ];
    }
}