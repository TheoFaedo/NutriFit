<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\vues\VuePage;

use app\autres\ConnectionFactory;
use app\autres\FonctionsUtiles;

use app\models\Plat;

class ControleurCreerPlat {

    private $container;

    public function __construct($container){
        $this->container = $container;
    }
    
    public function getPage($rq, $rs, $args) {

        ConnectionFactory::creerConnection();

        $nom = $rq->getParsedBodyParam("nom");
        $energie = $rq->getParsedBodyParam("energie");
        $lipides = $rq->getParsedBodyParam("lipides");
        $glucides = $rq->getParsedBodyParam("glucides");
        $proteines = $rq->getParsedBodyParam("proteines");

        $plat = new Plat();
        $plat->nom = $nom;
        $plat->energie = $energie;
        $plat->lipides = $lipides;
        $plat->glucides = $glucides;
        $plat->proteines = $proteines;
        $plat->save();

        $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/");
        return $rs;
    }
}
