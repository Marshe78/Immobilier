<?php

namespace Core\Controller;

use Core\Traits\JsonTrait;
use App\Security\JwTokenSecurity;
use Core\Model\DefaultModel;

class DefaultController
{
    use JsonTrait;

    public function isGranted(string $role): ?bool {
        $user = (new JwTokenSecurity)->verifyToken();
        if(is_array($user['Role'])){
            if(!in_array($role, $user['Role']) ){
                throw new \Exception("Accès interdit, vous n'avez pas les droits");
            }
        }else{
            if($role !== $user['Role'] ){
                throw new \Exception("Accès interdit, vous n'avez pas les droits");
            }
        }
        return true;
    }


    public function getUserId(): ?int {

        $user = (new JwTokenSecurity)->verifyToken();
        if(isset($user['Id'])){
            return $user['Id'];
        }
        throw new \Exception("Accès interdit, vous n'avez pas les droits");
    }
}
