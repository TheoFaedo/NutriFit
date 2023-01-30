<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\autres\ConnectionFactory;
use app\autres\FonctionsUtiles;

use app\models\Plat;
use app\models\Prise;

class ControleurGetPriseJour {

    private $container;

    public function __construct($container){
        $this->container = $container;
    }
    
    public function getPage($rq, $rs, $args) {

        ConnectionFactory::creerConnection();
        session_start();
        
        $prises = Prise::orderBy('date_prise', 'DESC')->where("date_prise", ">", (date('Y-m-d')." 00:00:00"), "AND", "date_prise", "<", (date('Y-m-d')." 23:59:59"))->where("id_user", "=", $_SESSION["id_user"])->get();
        $prisesArr = [];
        foreach ($prises as $prise) {
            $plat = $prise->plat()->first();
            array_push($prisesArr, array(
                "id_prise" => $prise->id_prise,
                "date_prise" => \DateTime::createFromFormat("Y-m-d H:i:s", $prise->date_prise)->format("H:i"),
                "nom" => $plat->nom, 
                "energie" => $plat->energie * $prise->multiplicateurPoids, 
                "lipides" => $plat->lipides * $prise->multiplicateurPoids, 
                "glucides" => $plat->glucides * $prise->multiplicateurPoids, 
                "proteines" => $plat->proteines * $prise->multiplicateurPoids
            ));
        }

        $res = array("prises" => $prisesArr);
        
        return $rs->withJson($res, 201);
    }
}
