<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\vues\VueConnection;

use app\autres\ConnectionFactory;
use app\autres\FonctionsUtiles;

use app\models\User;

class ControleurConnection {

    private $container;

    public function __construct($container){
        $this->container = $container;
    }
    
    public function getPage($rq, $rs, $args) {

        session_start();
        $BaseUrl = $rq->getUri()->getBasePath();

        $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/");
        if(isset($_SESSION["token"])){
            $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/");
        }else{
            ConnectionFactory::creerConnection();
            $name = $rq->getParsedBodyParam("name");
            $mdp = $rq->getParsedBodyParam("password");

            $user = User::where("pseudo", "=", $name)->first();

            if(!password_verify($mdp, $user->password)){
                $user =null;
            }

            if($user != null){
                $_SESSION["token"] = $user->token;
                $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/");
            }else{
                $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/connect");
            }
        }
        
        return $rs;
    }
}
