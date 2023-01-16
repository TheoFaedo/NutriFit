<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\vues\VuePage;

use app\autres\ConnectionFactory;
use app\autres\FonctionsUtiles;

use app\models\User;
class ControleurInscription {

    private $container;

    public function __construct($container){
        $this->container = $container;
    }
    
    public function getPage($rq, $rs, $args) {

        session_start();
        $BaseUrl = $rq->getUri()->getBasePath();

        if(isset($_SESSION["id_user"])){
            $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/");
        }else{
            ConnectionFactory::creerConnection();

            //Recuperation des données
            $name = $rq->getParsedBodyParam("username");
            $password = $rq->getParsedBodyParam("password");

            //Hachage du mot de passe
            $password = password_hash($password, PASSWORD_DEFAULT);

            //Enregistrement dans la base de données
            $user = new User();
            $user->pseudo = $name;
            $user->password = $password;
            $user->save();
            $user->token = hash("sha256", ($user->id_user."4uD1D30uF"));
            $user->save();

            if($user != null){
                $_SESSION["id_user"] = $user->id_user;
                $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/");
            }else{
                $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/signin");
            }
        }
        return $rs;
    }
}
