<?php

namespace App\Controller;

use App\Model\RendezVousModel;
use App\Model\AttribuerModel;
use PHPMailer\PHPMailer\PHPMailer;
use Core\Controller\DefaultController;

use OpenApi\Attributes as OA;

final class RendezVousController extends DefaultController {

   private RendezVousModel $model;
   private AttribuerModel $modelAttribuer;
   

   public function __construct ()
   {
       $this->model = new RendezVousModel();
       $this->modelAttribuer = new AttribuerModel();
   }
   /**
    * Renvoie l'ensemble des Rdv 
    *
    * @return void
    */
    #[OA\Get(
        path:"/RendezVous",
        summary:"Retourne l'ensemble des rendez-vous",
        responses: [
            new OA\Response(
                response: 200,
                description: "Liste des RendezVous",
                content: new OA\JsonContent(
                    type:'array',
                    items: new OA\Items(
                        ref: "#/components/schemas/RendezVous"
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
   public function index (): void
   {
       $this->jsonResponse($this->model->findAll());
   }

    /**
     * Retourne un rdv en fonction de son id
     *
     * @param integer $rdv
     * @return void
     */
    #[OA\Get(
        path:"/RendezVous/{id}",
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
                description: "Retourne un rendez-vous de l'id en parametre",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/RendezVous"
                )
            )
        ]
    )]
    public function single (int $id)
    {
        $this->jsonResponse($this->model->find($id));
    }

    /**
     * Enregistre un RDV en BDD et retourne les informations enregistrées avec l'id
     *
     * @param array $rdv
     * @return void
     */
    public function save(): void
    {
        //Enregistrer en base de données
        $lastId = $this->model->saveRdv($_POST);
      
        // Envoie d'un Mail
         $sendMail = $this->model->sendMail($rdv);

        // Return du rdv
        $this->jsonResponse($this->model->find($lastId), 201);
    }

    /**
     * update un RDV en BDD et retourne les informations enregistrées avec l'id
     *
     * @param array $rdv
     * @return void
     */
    public function update(int $id, array $rdv): void
    {
        $this->isGranted('ROLE_USER');
        if ($this->model->updateRdv($id, $rdv)) {
            $this->jsonResponse($this->model->find($id), 201);
        }
    }

    public function user(){
      $this->jsonResponse($this->model->getRdvById($this->getUserId()), 200);
    }

    public function delete(int $id){
        $this->isGranted('ROLE_USER');
        $this->model->deleteByCustomId($id, $this->model->getIdTable());
        $this->modelAttribuer->deleteByCustomId($id,  $this->model->getIdTable());
        $this->model->deleteByCustomId($id, $this->model->getIdTable());

        $this->jsonResponse("Deleted",200);
    }
    
    
    /**
     * supprime un RDV en BDD et retourne les informations enregistrées avec l'id
     *
     * @param array $rdv
     * @return void
     */
    /*
    public function delete (int $id): void
    {
        if ($this->model->delete($id)) {
            $this->jsonResponse("Rendez vous supprimé avec succès");
        }
    }
    */
}
