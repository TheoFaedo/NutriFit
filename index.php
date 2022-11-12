<?php

require 'vendor/autoload.php';

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use app\controleurs\ControleurPage;
use app\controleurs\ControleurCreerPlat;

$c = new \Slim\Container(['settings'=>['displayErrorDetails'=>true]]);
$app = new \Slim\App($c);

/**
 * ROUTE PAGE ACCUEIL
 */
$app->get('/', function( $rq, $rs, $args ) {
    $cont= new ControleurPage($this, "accueil") ;

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
 * REQUETES POST
 */
$app->post('/requestCreerPlat[/]', function( $rq, $rs, $args ) {
    $cont= new ControleurCreerPlat($this) ;

    return $cont->getPage($rq, $rs, $args);
});

$app->run();