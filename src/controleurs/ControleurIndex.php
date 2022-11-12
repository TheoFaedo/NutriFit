<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\vues\VueAccueil;
use app\vues\VueConnaction;

use app\autres\ConnectionFactory;
use app\autres\FonctionsUtiles;
use app\autres\ModeleCourbe;

use app\models\User;
use app\models\UserActions;
use app\models\Actions;

class ControleurIndex {

    private $container;

    public function __construct($container){
        $this->container = $container;
    }
    
    public function getPage($rq, $rs, $args) {

        session_start();

        ConnectionFactory::creerConnection();

        if(!isset($_SESSION["token"])){
            $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/connect");
        }else{
            $user = User::where("token", "=", $_SESSION["token"])->first();
            
            if($user==null){
                $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/connect");
                return $rs;
            } 
            
            $v = new VueAccueil($rq, $user->token);
            $rs->getBody()->write($v->render());
        }
        
        return $rs;
    }
}
