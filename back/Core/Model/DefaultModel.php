<?php

namespace Core\Model;

use Core\Database\Database;
use Core\Traits\JsonTrait;

class DefaultModel extends Database
{
    use JsonTrait;

    protected string $table;
    protected string $entity;

    /**
     * @return array<int,object>
     */
    public function findAll(): array
    {
        try {
            $stmt = "SELECT * FROM $this->table";
            $query = $this->pdo->query($stmt, \PDO::FETCH_CLASS, "App\Entity\\$this->entity");
            return $query->fetchAll();
        } catch (\PDOException $e) {
            $this->jsonResponse($e->getMessage(), 400);
        }
    }

    public function find(int $id): object|false
    {
        try {
            $stmt = "SELECT * FROM $this->table WHERE $this->Id_table = $id";
            $query = $this->pdo->query($stmt, \PDO::FETCH_CLASS, "App\Entity\\$this->entity");
            return $query->fetch();
        } catch (\PDOException $e) {
            $this->jsonResponse($e->getMessage(), 400);
        }
    }

    public function findById(int $id): array|false
    {
        try {
            $stmt = "SELECT * FROM $this->table WHERE $this->Id_table = $id";
            $query = $this->pdo->query($stmt, \PDO::FETCH_CLASS, "App\Entity\\$this->entity");
            $arrayFetch = $query->fetchAll();
            $data = [];
            foreach($arrayFetch as $arr){
                array_push($data, $arr->Id_bien);
            }
           return $data; 
            
        } catch (\PDOException $e) {
            $this->jsonResponse($e->getMessage(), 400);
        }
    }

    public function delete(int $id): bool
    {
        try {
            $stmt = "DELETE FROM $this->table WHERE $this->Id_table = :id";
            $prepare = $this->pdo->prepare($stmt);
            $prepare->bindParam(':id', $id);
            return $prepare->execute();

        } catch (\PDOException $e) {
            $this->jsonResponse($e->getMessage(), 400);
        }
    }

    public function deleteByCustomId(int $id, $champ){
        try {
            $stmt = "DELETE FROM $this->table WHERE $champ = :id";
            $prepare = $this->pdo->prepare($stmt);
            $prepare->bindParam(':id', $id);
            return $prepare->execute();

        } catch (\PDOException $e) {
            $this->jsonResponse($e->getMessage(), 400);
        }
    }
}
