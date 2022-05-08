<?php
namespace App\Controller;

use App\Model\OptionBienModel;
use Core\Controller\DefaultController;

use App\Model\PossedeModel;

use OpenApi\Attributes as OA;

class OptionbienController extends DefaultController {

    private $model;
    private PossedeModel $modelPossede;

    public function __construct(){
        $this->model = new OptionBienModel();
        $this->modelPossede =  new PossedeModel();
    }

    #[OA\Get(
        path:"/optionbien",
        summary:"Retourne l'ensemble des options",
        responses: [
            new OA\Response(
                response: 200,
                description: "Liste des options",
                content: new OA\JsonContent(
                    type:'array',
                    items: new OA\Items(
                        ref: "#/components/schemas/Option_bien"
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
        path:"/optionbien/{id}",
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
                description: "Retourne une option",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Option_bien"
                )
            )
        ]
    )]
    public function single(int $id)
    {
        $this->jsonResponse($this->model->find($id), 200);
    }

    public function save(): void {
        $lastId = $this->model->saveOptionBien($_POST);
        $this->jsonResponse($this->model->find($lastId), 200);
    }

    public function update(int $id ,array $optionBien): void {
        if($this->model->updateOptionBien($id, $optionBien)){
            $this->jsonResponse($this->model->find($id), 201);
        }
    }

    public function delete(int $id){
        $this->modelPossede->deleteByCustomId($id, $this->model->getIdTable());
        $this->model->deleteByCustomId($id, $this->model->getIdTable());

        $this->jsonResponse("Deleted", 200);
    }
}