<?php

namespace App\Security;

use DateInterval;
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class JwTokenSecurity
{

    private const SIGNATURE = 'lifsAYTFhjfe567786875kfejsjjsYUGUhgUYUTiuhFY';
    private const ALGO = 'HS256';


    public function generateToken(array $payload = []): string|false
    {
        $date = new \DateTime();
        $exp = $date->add(new \DateInterval('P1D'));

        $defaultPayload = [
            'iss' => 'http://localhost:8000',
            'exp' => $exp->getTimestamp()
        ];

        $payload = array_merge($payload, $defaultPayload);

        return JWT::encode($payload, self::SIGNATURE, self::ALGO);
    }

    public function verifyToken(): array
    {
        $headers = getallheaders();

        if (!isset($headers['Token'])) throw new \Exception('Aucun Token détecté, vous devez être identifié.');

        $token = $headers['Token'];

        return (array) JWT::decode($token, new Key(self::SIGNATURE, self::ALGO));
    }
}
