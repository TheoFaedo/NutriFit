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

        session_start();

        ConnectionFactory::creerConnection();

        $nom = $rq->getParsedBodyParam("nom");
        $id_user = $_SESSION["id_user"];
        $energie = $rq->getParsedBodyParam("energie");
        $lipides = $rq->getParsedBodyParam("lipides");
        $glucides = $rq->getParsedBodyParam("glucides");
        $proteines = $rq->getParsedBodyParam("proteines");

        $plat = new Plat();
        $plat->nom = $nom;
        $plat->id_user = $id_user;
        $plat->energie = $energie;
        $plat->lipides = $lipides;
        $plat->glucides = $glucides;
        $plat->proteines = $proteines;
        $plat->save();

        $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/");
        return $rs;
    }
}
