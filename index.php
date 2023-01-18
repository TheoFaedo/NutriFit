<?php

require 'vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use app\controleurs\ControleurPage;
use app\controleurs\ControleurCreerPlat;
use app\controleurs\ControleurGetPlats;
use app\controleurs\ControleurAddPrise;
use app\controleurs\ControleurGetPriseJour;
use app\controleurs\ControleurGetObjectif;
use app\controleurs\ControleurSupPlat;
use app\controleurs\ControleurChangerObjectif;

use app\controleurs\ControleurInscription;
use app\controleurs\ControleurConnection;

$c = new \Slim\Container(['settings'=>['displayErrorDetails'=>true]]);
$app = new \Slim\App($c);

/***************************************
 * 
 *           Routes Pages
 * 
 ***************************************/

//Route ACCUEIL
$app->get('/', function( $rq, $rs, $args ) {
    $cont= new ControleurPage($this, "ajouterPlat") ;
    return $cont->getPage( $rq, $rs, $args);
});

//Route CREERPLAT
$app->get('/creerPlat[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurPage($this, "creerPlat") ;
    return $cont->getPage( $rq, $rs, $args);
});

//Route CREERPLAT
$app->get('/enregistrerPrise[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurPage($this, "ajouterPlat") ;
    return $cont->getPage( $rq, $rs, $args);
});

//Route PROFILE
$app->get('/profile[/]', function($rq, $rs, $args) {
    $cont= new ControleurPage($this, "profil") ;
    return $cont->getPage( $rq, $rs, $args);
});

//Route CONNECT
$app->get('/connect[/]', function($rq, $rs, $args) {
    $cont= new ControleurPage($this, "connection");
    return $cont->getPage($rq, $rs, $args);
});

//Route SIGNIN
$app->get('/signin[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurPage($this, "inscription");
    return $cont->getPage($rq, $rs, $args);
});

/***************************************
 * 
 *         Gestion Inscription
 * 
 ***************************************/

$app->post('/connectionRedirect[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurConnection($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->post('/inscriptionRedirect[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurInscription($this) ;

    return $cont->getPage($rq, $rs, $args);
});




/***************************************
 * 
 *              API
 * 
 ***************************************/

$app->post('/api/creerPlat[/]', function($rq, $rs, $args) {
    $cont= new ControleurCreerPlat($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->get('/api/getPlats[/]', function($rq, $rs, $args) {
    $cont= new ControleurGetPlats($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->get('/api/getPriseDuJour[/]', function($rq, $rs, $args) {
    $cont= new ControleurGetPriseJour($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->get('/api/getObjectif[/]', function($rq, $rs, $args) {
    $cont= new ControleurGetObjectif($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->post('/api/ajouterPrise[/]', function($rq, $rs, $args) {
    $cont= new ControleurAddPrise($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->post('/api/supprimerPlat[/]', function($rq, $rs, $args) {
    $cont= new ControleurSupPlat($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->post('/api/changerObjectifs[/]', function($rq, $rs, $args) {
    $cont= new ControleurChangerObjectif($this) ;

    return $cont->getPage($rq, $rs, $args);
});



//RUN
$app->run();