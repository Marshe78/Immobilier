<?php
namespace App\Api;
use OpenApi\Attributes as OA;

// ./vendor/bin/openapi --format yaml --output ./src/Api/swagger.yaml ./src

#[OA\info(
    title : 'SuperBlog',
    version : 1.0,
    description : 'Api php agence immobilière'
)]

#[OA\Server(
    url : 'localhost:8080',
    description : 'Serveur'
)]

Class OpenApi{}