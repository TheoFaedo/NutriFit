<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\vues\VueAccueil;
use app\vues\VueCreerPlat;

use app\autres\ConnectionFactory;
use app\autres\FonctionsUtiles;

use app\models\User;
use app\models\UserActions;
use app\models\Actions;

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
        $v;
        switch($this->nomPage){
            case "accueil":
                $v = new VueAccueil($rq);
                break;
            case "creerPlat":
                $v = new VueCreerPlat($rq);
                break;
            case "ajouterPlat":
                $v = new VueInscription($rq);
                break;
            default:
                $v = new VueAccueil($rq);
                break;
        }      
        $rs->getBody()->write($v->render());
        return $rs;
    }
}
