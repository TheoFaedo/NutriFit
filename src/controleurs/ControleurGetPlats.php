<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\vues\VuePage;

use app\autres\ConnectionFactory;
use app\autres\FonctionsUtiles;
use app\autres\Erreur;
use app\autres\Verificateur;

use app\models\Plat;

class ControleurGetPlats {

    private $container;

    public function __construct($container){
        $this->container = $container;
    }
    
    public function getPage($rq, $rs, $args) {

        ConnectionFactory::creerConnection();

        session_start();

        if(!Verificateur::verifierUtilisateurAuthentifie($rs)) return $rs->withJSON(array("erreur" => Erreur::getMessage("noauthenticated")), 400);

        $plats = Plat::all()->where("id_user", "=", $_SESSION["id_user"]);

        $platsArr = [];
        foreach ($plats as $value) {
            $platsArr[$value->id_plat] = array(
                "nom" => $value->nom, 
                "energie" => $value->energie, 
                "lipides" => $value->lipides, 
                "glucides" => $value->glucides, 
                "proteines" => $value->proteines
            );
        }

        $res = array("plats" => $platsArr);
        
        return $rs->withJson($res, 201);
    }
}
