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

        $v;
        switch($this->nomPage){
            case "creerPlat":
                $v = new VueCreerPlat($rq);
                break;

            case "ajouterPlat":
                $v = new VueAjouterPlat($rq);
                break;

            case "profil":
                if(!isset($_SESSION["id_user"])){
                    return $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/connect");
                }
                $v = new VueProfil($rq);
                break;

            case "connection":
                $v = new VueConnection($rq);
                break;

            case "inscription":
                $v = new VueInscription($rq);
                break;

            default:
                $v = new VueAjouterPlat($rq);
                break;
        }      
        $rs->getBody()->write($v->render());
        return $rs;
    }
}
