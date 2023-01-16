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
use app\autres\FonctionsUtiles;

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
    
    public function getPage($rq, $rs, $args) {  

        session_start();
        if(!isset($_SESSION["id_user"])){
            switch($this->nomPage){
                case "connection":
                    $v = new VueConnection($rq);
                    $rs->getBody()->write($v->render());
                    return $rs;
    
                case "inscription":
                    $v = new VueInscription($rq);
                    $rs->getBody()->write($v->render());
                    return $rs;
            }
            return $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/connect");
        }

        $v;
        switch($this->nomPage){
            case "creerPlat":
                $v = new VueCreerPlat($rq);
                break;

            case "ajouterPlat":
                $v = new VueAjouterPlat($rq);
                break;

            case "profil":
                $v = new VueProfil($rq);
                break;

            default:
                $v = new VueAjouterPlat($rq);
                break;
        }      
        $rs->getBody()->write($v->render());
        return $rs;
    }
}
