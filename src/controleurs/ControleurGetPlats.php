<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\vues\VuePage;

use app\autres\ConnectionFactory;
use app\autres\FonctionsUtiles;

use app\models\Plat;

class ControleurGetPlats {

    private $container;

    public function __construct($container){
        $this->container = $container;
    }
    
    public function getPage($rq, $rs, $args) {

        ConnectionFactory::creerConnection();

        $plats = Plat::all();

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
        
        return $rs->withJson($res, 201, JSON_PRETTY_PRINT);
    }
}
