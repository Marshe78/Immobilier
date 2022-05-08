<?php

namespace App\Controller;

use App\Model\GererModel;
use Core\Controller\DefaultController;

use OpenApi\Attributes as OA;

class GererController extends DefaultController
{
    public function __construct(){
        $this->model = new GererModel();
    }

    #[OA\Get(
        path:"/gerer",
        summary:"Retourne l'ensemble des utilisateurs",
        responses: [
            new OA\Response(
                response: 200,
                description: "Liste des ID entre un utilisateur & un bien",
                content: new OA\JsonContent(
                    type:'array',
                    items: new OA\Items(
                        ref: "#/components/schemas/Gerer"
                    )
                )
            ),
            new OA\Response(
                response: 404,
                description: "Not Found",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(
                            property:"message",
                            type:"string",
                            example:"Route not found"
                        )
                    ]
                )
            )
        ]
    )]
    public function index(): void
    {
        $this->jsonResponse($this->model->findAll(), 200);
    }

    #[OA\Get(
        path:"/gerer/{id}",
        parameters: [
            new OA\Parameter(
                name:"id",
                in:"path",
                required:true,
                schema: new OA\Schema(type:"integer")
            )
        ],
        responses: [
            new OA\Response(
                response: 200,
                description: "Retourne les id de l'utilisateur & l'id du bien",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Gerer"
                )
            )
        ]
    )]
    public function single(int $id)
    {
        $this->jsonResponse($this->model->findById($id), 200);
    }

    public function save(): void {
        if($this->isGranted('ROLE_USER') || $this->isGranted('ROLE_ADMIN')) {
            $lastId = $this->model->saveGerer($this->getUserId(), $_POST);
            $this->jsonResponse($this->model->find($lastId), 200);
        }
    }

    public function update(int $id ,array $gerer): void {
        if($this->isGranted('ROLE_USER') || $this->isGranted('ROLE_ADMIN')){
            if($this->model->updateGerer($id, $gerer)){
                $this->jsonResponse($this->model->find($id), 201);
            }
        }
    }
}
