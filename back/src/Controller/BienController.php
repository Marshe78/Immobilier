<?php
namespace App\Controller;

use App\Model\BienModel;
use Core\Controller\DefaultController;

use App\Model\PossedeModel;
use App\Model\AttribuerModel;
use App\Model\GererModel;

use OpenApi\Attributes as OA;

class BienController extends DefaultController {

    private $model;
    private PossedeModel $modelPossede;
    private AttribuerModel $modelAttribuer;
    private GererModel $modelGerer;

    public function __construct(){
        $this->model = new BienModel();
        $this->modelPossede = new PossedeModel();
        $this->modelAttribuer = new AttribuerModel();
        $this->modelGerer = new GererModel();
    }

    #[OA\Get(
        path:"/utilisateur",
        summary:"Retourne l'ensemble des biens",
        responses: [
            new OA\Response(
                response: 200,
                description: "Liste des Bien",
                content: new OA\JsonContent(
                    type:'array',
                    items: new OA\Items(
                        ref: "#/components/schemas/Bien"
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
        path:"/bien/{id}",
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
                description: "Retourne un bien",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Bien"
                )
            )
        ]
    )]
    public function single(int $id)
    {
        $this->jsonResponse($this->model->find($id), 200);
    }

    public function save(): void {
       
        $lastId = $this->model->saveBien($_POST);
        $this->jsonResponse($this->model->find($lastId), 200);
    }

    public function update(int $id ,array $bien): void {
        
        if($this->model->updateBien($id , $bien)){
            $this->jsonResponse($this->model->find($id), 201);
        }
    }

    public function delete(int $id){

        $this->modelPossede->deleteByCustomId($id, $this->model->getIdTable());
        $this->modelAttribuer->deleteByCustomId($id, $this->model->getIdTable());
        $this->modelGerer->deleteByCustomId($id, $this->model->getIdTable());
        $this->model->deleteByCustomId($id, $this->model->getIdTable());

        $this->jsonResponse("Deleted",200);
    }
}