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

        $prises = Prise::where("date_prise", ">", (date('Y-m-d')." 00:00:00"), "AND", "date_prise", "<", (date('Y-m-d')." 23:59:59"))->get();
        $prisesArr = [];
        foreach ($prises as $value) {
            $plat = $value->plat()->first();
            $prisesArr[$value->id_prise] = array(
                "date_prise" => \DateTime::createFromFormat("Y-m-d H:i:s", $value->date_prise)->format("H:i"),
                "nom" => $plat->nom, 
                "energie" => $plat->energie, 
                "lipides" => $plat->lipides, 
                "glucides" => $plat->glucides, 
                "proteines" => $plat->proteines
            );
        }

        $res = array("prises" => $prisesArr);
        
        return $rs->withJson($res, 201);
    }
}
