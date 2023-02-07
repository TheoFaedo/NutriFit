<?php

namespace app\autres;

require 'vendor/autoload.php';

use app\models\User;

class Verificateur{

    public static function verifierUtilisateurAuthentifie(){

        if(!isset($_SESSION["id_user"])) return false;
        
        $usertest = User::where("id_user", "=", $_SESSION["id_user"]);
        if($usertest == null) return false;

        return true;
    }

    public static function verifierParametresDuCorpDeLaRequeteNonNull($tabParametresDeLaRequete){
        foreach ($tabParametresDeLaRequete as $value) {
            if($value==null){
                return false;
            }
        }
        return true;
    }

}