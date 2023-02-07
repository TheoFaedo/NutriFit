<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\autres\ConnectionFactory;
use app\autres\FonctionsUtiles;
use app\autres\Erreur;
use app\autres\Verificateur;

use app\models\User;

class ControleurGetObjectif {

    private $container;

    public function __construct($container){
        $this->container = $container;
    }
    
    public function getPage($rq, $rs, $args) {

        ConnectionFactory::creerConnection();

        session_start();

        if(!Verificateur::verifierUtilisateurAuthentifie($rs)) return $rs->withJSON(array("erreur" => Erreur::getMessage("noauthenticated")), 400);

        $user = User::where("id_user", "=", $_SESSION["id_user"])->first();

        $res = array("objectif" => array(
                "obj_nom" => $user->pseudo, 
                "obj_energie" => $user->oj_energie, 
                "obj_lipides" => $user->oj_lipides, 
                "obj_glucides" => $user->oj_glucides, 
                "obj_proteines" => $user->oj_proteines
        ));
        
        return $rs->withJson($res, 201);
    }
}
