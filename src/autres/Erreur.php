<?php

namespace app\autres;

class Erreur{

    public static function getMessage($codeErreur){

        switch($codeErreur){
            case "incorrectpassword":
                return "Mot de passe au identifiant incorrect";
            case "pseudoexist":
                return "Le pseudo est déjà utilisé par un autre utilisateur";
            case "noauthenticated":
                return "Vous devez être authentifier pour effectuer cette action";
            case "platexist":
                return "Un autre de plat de même nom existe déjà";
            case "platnoname":
                return "Le plat doit porter un nom";
            case "passwordnotconfirmed":
                return "Les deux mots de passe ne correspondent pas";
            case "emptyparam":
                return "Un ou plusieurs paramètres n'ont pas été renseignés";
            default:
                return "Une erreur est survenue";
        }
    }
    
}