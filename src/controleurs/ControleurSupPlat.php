<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\vues\VuePage;

use app\autres\ConnectionFactory;
use app\autres\FonctionsUtiles;

use app\models\Prise;

class ControleurSupPlat {

    private $container;

    public function __construct($container){
        $this->container = $container;
    }
    
    public function getPage($rq, $rs, $args) {

        ConnectionFactory::creerConnection();

        $id = $rq->getParsedBodyParam("id");
        
        $plat = Prise::find($id);
        $plat->delete();

        $res = array("result" => "0");
        return $rs->withJson($res, 201);
    }
}
