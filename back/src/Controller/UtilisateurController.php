<?php
namespace App\Controller;

use App\Model\UtilisateurModel;
use Core\Controller\DefaultController;
use App\Security\JwTokenSecurity;

use App\Model\GererModel;
use App\Model\RendezVousModel;

use OpenApi\Attributes as OA;

class UtilisateurController extends DefaultController {

    private UtilisateurModel $model;
    private GererModel $modelGerer;
    private RendezVousModel $modelRdv;

    public function __construct(){
        $this->model = new UtilisateurModel;
        $this->modelGerer = new GererModel;
        $this->modelRdv = new RendezVousModel;
    }

    #[OA\Get(
        path:"/utilisateur",
        summary:"Retourne l'ensemble des utilisateurs",
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
    public function index(){
        $this->isGranted('ROLE_ADMIN');
        $this->jsonResponse($this->model->findAll(), 200);
    }


    #[OA\Get(
        path:"/utilisateur/{id}",
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
                description: "Retourne un utilisateur de l'id en parametre",
                content: new OA\JsonContent(
                    ref: "#/components/schemas/Utilisateur"
                )
            )
        ]
    )]
    public function single(int $id){
        $this->jsonResponse($this->model->find($id), 200);
    }

    #[OA\Post(
        path:"/utilisateur/sign",
        requestBody: new OA\RequestBody(
            request: "Ajout d'un utilisateur",
            required:true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property:"Email", type:"string"),
                    new OA\Property(property:"Password", type:"string"),
                ]
            )
        )
    )]
    public function sign(){

        $this->isGranted('ROLE_ADMIN');
        if($this->model->getUserByEmail($_POST['Email'])) return $this->jsonResponse("L'utilisateur existe deja",400);

        if(isset($_POST["Nom"], $_POST["Prenom"], $_POST["Email"], $_POST["Password"])){
            $user = $_POST;
            $user['Password'] = password_hash($user['Password'], PASSWORD_DEFAULT);
            $user['Role'] = $user['Role'];
            $lastId = $this->model->saveUser($user);

            $this->jsonResponse($this->model->find($lastId), 200);
        }
    }

    #[OA\Post(
        path:"/utilisateur/login",
        requestBody: new OA\RequestBody(
            request: "Connexion",
            required:true,
            content: new OA\JsonContent(
                properties: [
                    new OA\Property(property:"Email", type:"string"),
                    new OA\Property(property:"Password", type:"string"),
                ]
            )
        ),
        responses: [
            new OA\Response(
                response: 200,
                description: "Retourne un token",
                content: new OA\JsonContent(
                    properties: [
                        new OA\Property(property:"Token", type:"string"),
                    ]
                )
            )
        ]
    )]
    public function login(array $userData){
        $user = $this->model->getUserByEmail($userData['Email']);
        if($user){
            
            if(password_verify($userData['Password'], $user->getPassword())){
                $arr = [
                    'Id' => $user->getIdUtilisateur(),
                    'Nom' => $user->getNom(),
                    'Prenom' => $user->getPrenom(),
                    'Role' => $user->getRole(),
                ];

                $this->jsonResponse((new JwTokenSecurity)->generateToken($arr), 200);
            }else {
                $this->jsonResponse("Mot de passe incorrect", 400);
            }
        }else {
            $this->jsonResponse("Cet utilisateur n'existe pas", 400);
        }
    }

    public function update(int $id, array $array){
        $this->isGranted('ROLE_ADMIN');
        if($this->model->updateUser($id, $array)){
            $this->jsonResponse($this->model->find($id), 200);
        }
    }

    public function delete(int $id){
        $this->isGranted('ROLE_ADMIN');
        $this->modelGerer->deleteByCustomId($id, $this->model->getIdTable());
        $this->modelRdv->deleteByCustomId($id, $this->model->getIdTable());
        $this->model->deleteByCustomId($id, $this->model->getIdTable());

        $this->jsonResponse("Deleted",200);
    }
}