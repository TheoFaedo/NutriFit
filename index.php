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

$c = new \Slim\Container(['settings'=>['displayErrorDetails'=>true]]);
$app = new \Slim\App($c);

/**
 * ROUTE PAGE ACCUEIL
 */
$app->get('/', function( $rq, $rs, $args ) {
    $cont= new ControleurPage($this, "ajouterPlat") ;

    return $cont->getPage( $rq, $rs, $args );
});

/**
 * ROUTE PAGE CreerPartie
 */
$app->get('/creerPlat[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurPage($this, "creerPlat") ;

    return $cont->getPage( $rq, $rs, $args );
});

/**
 * ROUTE PAGE EnregistrerPrise
 */
$app->get('/enregistrerPrise[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurPage($this, "ajouterPlat") ;

    return $cont->getPage( $rq, $rs, $args );
});

/**
 * ROUTE PAGE Profile
 */
$app->get('/profile[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurPage($this, "ajouterPlat") ;

    return $cont->getPage( $rq, $rs, $args );
});

/**
 * ROUTE PAGE Connect
 */
$app->get('/connect[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurPage($this, "ajouterPlat") ;

    return $cont->getPage( $rq, $rs, $args );
});

/**
 * ROUTE PAGE Inscription
 */
$app->get('/signin[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurPage($this, "ajouterPlat") ;

    return $cont->getPage( $rq, $rs, $args );
});


/**
 * API
 */
$app->post('/requestCreerPlat[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurCreerPlat($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->get('/requestGetPlats[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurGetPlats($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->get('/requestGetPriseDuJour[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurGetPriseJour($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->get('/requestGetObjectif[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurGetObjectif($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->post('/requestAjouterPrise[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurAddPrise($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->post('/requestSupprimerPlat[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurSupPlat($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->run();