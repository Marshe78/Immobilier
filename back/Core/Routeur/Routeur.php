<?php

namespace Core\Routeur;

class Routeur
{
    public static function router()
    {
        if (isset($_SERVER["PATH_INFO"])) {
            $path = explode("/", $_SERVER["PATH_INFO"]);

            if (isset($path[1])) {
                $controllerName = "App\Controller\\" . ucfirst($path[1]) . "Controller";
                $controller = new $controllerName;
            }

            $id = null;

            if (isset($path[2]) && is_numeric($path[2])) {
                $id = $path[2];
            }

            switch ($_SERVER['REQUEST_METHOD']) {
                case 'GET':
                    if ($id) {
                        $controller->single($id);
                    } else {
                        if(isset($path[2])  && $path[2] === 'user'){
                            $method = $path[2];
                            if(method_exists($controller, $method)){
                                $controller->$method();
                            }else {
                                throw new \Exception("La méthode $method n'exist pas");
                            }
                        }else{
                            $controller->index();
                        }
                    }
                    /*
                    if(isset($path[2])  && is($path[2])){
                        $method = $path[2];
                        if(method_exists($controller, $method)){
                            $controller->$method();
                        }else {
                            throw new \Exception("La méthode $method n'exist pas");
                        }
                    } else {
        
                    }
                    */
                    break;
                
                case 'POST':
                    if (!empty($_POST)) {
                        if (isset($path[2]) && is_string($path[2])) {
                            $method = $path[2];
                            if (method_exists($controller, $method)) {
                                $controller->$method($_POST);
                            } else {
                                throw new \Exception("La méthode $method n'exist pas", 400);
                            }
                        } else {
                            $controller->save($_POST);
                        }
                    } else {
                        throw new \Exception("Données manquanes pour l'ajout en BDD", 400);
                    }
                    break;
                case 'PUT':
                    parse_str(file_get_contents("php://input"), $_PUT);
                    if ($id && !empty($_PUT)) {
                        $controller->update($id, $_PUT);
                    } else {
                        throw new \Exception("Erreur lors de la modification, il manque des informations", 400);
                    }
                    break;
                case 'PATCH':
                    parse_str(file_get_contents("php://input"), $_PATCH);
                    if ($id && !empty($_PATCH)) {
                        $controller->update($id, $_PATCH);
                    } else {
                        throw new \Exception("Erreur lors de la modification, il manque des informations", 400);
                    }
                    break;
                case 'DELETE':
                    if ($id) {
                        $controller->delete($id);
                    } else {
                        throw new \Exception("Id manquant", 400);
                    }
                    break;
            }
        }
    }
}
