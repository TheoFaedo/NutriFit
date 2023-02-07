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
            $confirm_password = $rq->getParsedBodyParam("confirm_password");

            if(User::where('pseudo', '=', $name)->first() != null){
                $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/signin?err=pseudoexist");
                return $rs;
            }

            if($password != $confirm_password){
                $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/signin?err=passwordnotconfirmed");
                return $rs;
            }

            //Hachage du mot de passe
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            //Enregistrement dans la base de données
            $user = new User();
            $user->pseudo = $name;
            $user->password = $hashed_password;
            $user->save();
            $user->token = hash("sha256", ($user->id_user."4uD1D30uF"));
            $user->save();

            if($user != null){
                $_SESSION["id_user"] = $user->id_user;
                $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/");
            }else{
                $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/signin?err=erreurinconnue");
            }
        }
        return $rs;
    }
}
