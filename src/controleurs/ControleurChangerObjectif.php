<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\vues\VuePage;

use app\autres\ConnectionFactory;
use app\autres\FonctionsUtiles;

use app\models\User;

class ControleurChangerObjectif {

    private $container;

    public function __construct($container){
        $this->container = $container;
    }
    
    public function getPage($rq, $rs, $args) {

        session_start();
        ConnectionFactory::creerConnection();

        $user = User::where("id_user", "=", $_SESSION["id_user"])->first();

        $energie = $rq->getParsedBodyParam("energie");
        $proteines = $rq->getParsedBodyParam("proteines");
        $glucides = $rq->getParsedBodyParam("glucides");
        $lipides = $rq->getParsedBodyParam("lipides");

        $user->oj_energie = $energie;
        $user->oj_proteines = $proteines;
        $user->oj_glucides = $glucides;
        $user->oj_lipides = $lipides;
        $user->save();

        $res = array("result" => "0");
        return $rs->withJson($res, 201);
    }
}
