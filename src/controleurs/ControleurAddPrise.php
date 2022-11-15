<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\autres\ConnectionFactory;
use app\autres\FonctionsUtiles;

use app\models\Plat;
use app\models\Prise;

class ControleurAddPrise {

    private $container;

    public function __construct($container){
        $this->container = $container;
    }
    
    public function getPage($rq, $rs, $args) {

        ConnectionFactory::creerConnection();

        $id = $rq->getParsedBodyParam("id");

        $prise = new Prise();
        $prise->plat = $id;
        $prise->multiplicateurPoids = 1;
        $prise->date_prise = date('Y-m-d H:i:s');
        $prise->save();

        $res = array(1 => "success");
        
        return $rs->withJson($res, 201);
    }
}
