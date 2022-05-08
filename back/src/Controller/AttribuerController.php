<?php
namespace App\Controller;

use App\Model\AttribuerModel;
use Core\Controller\DefaultController;

use OpenApi\Attributes as OA;

class AttribuerController extends DefaultController {

    private $model;

    public function __construct(){
        $this->model = new AttribuerModel();
    }

    #[OA\Get(
        path:"/attribuer",
        summary:"Retourne l'ensemble des attributions entre un rendez-vous & un bien",
        responses: [
            new OA\Response(
                response: 200,
                description: "Retourne les IDs entre un rendez-vous & un bien",
                content: new OA\JsonContent(
                    type:'array',
                    items: new OA\Items(
                        ref: "#/components/schemas/Attribuer"
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
        path:"/attribuer/{id}",
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
                description: "Retourne ",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Attribuer"
                )
            )
        ]
    )]
    public function single(int $id): void
    {
        $this->jsonResponse($this->model->find($id), 200);
    }

    public function save($id): void {
        $lastId = $this->model->saveAttribuer($_POST);
        $this->jsonResponse($this->model->find($id), 200);
    }

    public function update(int $id ,array $attribuer): void {
        if($this->model->updateAttribuer($id , $attribuer)){
            $this->jsonResponse($this->model->find($id), 201);
        }
    }
    /*
    public function delete(int $id) : void {
        if($this->model->delete($id)){
            $this->jsonResponse("le bien a été supprimé", 200);
        }
    }
    */
}