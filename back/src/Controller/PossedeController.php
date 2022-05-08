<?php
namespace App\Controller;

use App\Model\PossedeModel;
use Core\Controller\DefaultController;

use OpenApi\Attributes as OA;

class PossedeController extends DefaultController {

    private $model;

    public function __construct(){
        $this->model = new PossedeModel();
    }


    #[OA\Get(
        path:"/possede",
        summary:"Retourne l'ensemble des IDs entre bien & option bien",
        responses: [
            new OA\Response(
                response: 200,
                description: "Liste des ID entre Bien & Option bien",
                content: new OA\JsonContent(
                    type:'array',
                    items: new OA\Items(
                        ref: "#/components/schemas/Possede"
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
        path:"/possede/{id}",
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
                description: "Retourne deux Id",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Possede"
                )
            )
        ]
    )]
    public function single(int $id)
    {
        $this->jsonResponse($this->model->findById($id), 200);
    }

    public function save(): void {
        $lastId = $this->model->savePossede($_POST);
        $this->jsonResponse($this->model->find($lastId), 200);
    }

    public function update(int $id ,array $possede): void {
        if($this->model->updatePossede($id, $possede)){
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