<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\vues\VueAccueil;
use app\vues\VueCreerPlat;
use app\vues\VueAjouterPlat;
use app\vues\VueProfil;
use app\vues\VueInscription;
use app\vues\VueConnection;

use app\autres\ConnectionFactory;
use app\autres\Erreur;

use app\models\User;

/**
 * Controleur dont le but est de rediriger vers des pages spécifique dont l'identifiant est donnée en paramètre.
 */
class ControleurPage {

    private $container;
    private $nomPage;

    public function __construct($container, $nomPage){
        $this->container = $container;
        $this->nomPage = $nomPage;
    }
    
    public function getPage($rq, $rs, $args){ 
        
        $erreur = "";
        if(isset($_GET["err"]))
            $erreur = Erreur::getMessage($_GET["err"]);

        session_start();
        $v;

        if(!isset($_SESSION["id_user"])){
            switch($this->nomPage){
                case "connection":
                    $v = new VueConnection($rq, $erreur);
                    $rs->getBody()->write($v->render());
                    return $rs;
    
                case "inscription":
                    $v = new VueInscription($rq, $erreur);
                    $rs->getBody()->write($v->render());
                    return $rs;
            }
            return $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/connect");
        }

        ConnectionFactory::creerConnection();
        $user = User::where("id_user", "=", $_SESSION["id_user"])->first();

        switch($this->nomPage){
            case "creerPlat":
                $v = new VueCreerPlat($rq, $erreur);
                break;

            case "ajouterPlat":
                $v = new VueAjouterPlat($rq);
                break;

            case "profil":
                $v = new VueProfil($rq, $user);
                break;

            default:
                $v = new VueAjouterPlat($rq);
                break;
        }      
        $rs->getBody()->write($v->render());
        return $rs;
    }
}
