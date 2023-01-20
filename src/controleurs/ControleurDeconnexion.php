<?php
namespace app\controleurs;

require 'vendor/autoload.php';

use app\vues\VueConnection;

class ControleurDeconnexion {

    private $container;

    public function __construct($container){
        $this->container = $container;
    }
    
    public function getPage($rq, $rs, $args) {

        session_start();
        $BaseUrl = $rq->getUri()->getBasePath();

        if(isset($_SESSION["id_user"])){
            unset($_SESSION["id_user"]);
        }
        $rs = $rs->withHeader('Location', $rq->getUri()->getBasePath() . "/connect");
        return $rs;
    }
}
