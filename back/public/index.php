<?php

use Core\Routeur\Routeur;
// use App\Controller\ArticleController;
// use App\Controller\CategorieController;
// use App\Controller\BienController;

define('ROOT', dirname(__DIR__));
require ROOT . "/vendor/autoload.php";


header('Access-Control-Allow-Origin: *');
// Indique les headers autorisés par l'api
header("Access-Control-Allow-Headers: content-type, Token, Authorization");
// Indique les request methods autorisées par l'api
header("Access-Control-Allow-Methods: GET, PATCH, OPTIONS, POST, PUT, DELETE");
// Indique le temps d'existence max de ces données. Cette information va être utilisée pour le cache
header('Access-Control-Max-Age:1728000');

header("Content-Type: application/x-www-form-urlencoded");

require ROOT . "/Core/Routeur/Routeur.php";
Routeur::router();


/*
if (isset($_SERVER["PATH_INFO"])) {
    $path = explode("/", $_SERVER["PATH_INFO"]);
    if (isset($path[1])) {
        
        $controllerName = "App\Controller\\" . ucfirst($path[1]) . "Controller";
        $controller = new $controllerName();

        if (isset($path[4]) && is_numeric($path[4])) {
            $controller->single($path[4]);
        } elseif (isset($path[4]) && is_string($path[4])) {
            $method = $path[4];
            $controller->$method();
        } else {
            $controller->index();
        }
        
    }
} else {
    //TODO
}
*/
//(new CategorieController)->index();
//(new ArticleController)->index();
