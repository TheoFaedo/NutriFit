<?php
namespace app\autres;

use \Psr\Http\Message\ServerRequestInterface as Request;
use \Psr\Http\Message\ResponseInterface as Response;

use Illuminate\Database\Capsule\Manager as DB;

class ConnectionFactory{
        
    static function creerConnection(){
        $db = new DB();

        $db->addConnection(parse_ini_file("db.config.ini"));
 
        $db->setAsGlobal();
        $db->bootEloquent(); //On lance Eloquent

        return $db;
    }
}