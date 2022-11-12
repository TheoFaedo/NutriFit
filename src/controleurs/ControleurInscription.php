<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\vues\VuePage;

use app\autres\ConnectionFactory;
use app\autres\FonctionsUtiles;

use app\models\User;
use app\models\UserActions;
use app\models\Actions;

class ControleurInscription {

    private $container;

    public function __construct($container){
        $this->container = $container;
    }
    
    public function getPage($rq, $rs, $args) {

        session_start();
        $BaseUrl = $rq->getUri()->getBasePath();

        if(isset($_SESSION["token"])){
            $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/");
        }else{
            ConnectionFactory::creerConnection();
            $name = $rq->getParsedBodyParam("name");
            $mdp = $rq->getParsedBodyParam("mdp");


            $mdp = password_hash($mdp, PASSWORD_DEFAULT);

            $user = new User();
            $user->pseudo = $name;
            $user->mdp = $mdp;
            $user->money = 5000;
            $user->save();
            $user->token = hash("sha256", $user->idUser."4uD1D30uF@");
            $user->save();

            if($user != null){
                $_SESSION["token"] = $user->token;
                $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/");
            }else{
                $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/signin");
            }
        }
        
        return $rs;
    }
}
