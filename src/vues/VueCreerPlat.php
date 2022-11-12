<?php
namespace app\vues;

use app\autres\CoeficientX;
use app\autres\EquationCourbe;
use app\autres\FonctionsUtiles;
use app\autres\ModeleCourbe;

class VueCreerPlat{

    private $rq;

    public function __construct($rq){
        $this->rq = $rq;
    }

    public function render(){

        $BaseUrl = $this->rq->getUri()->getBasePath();

        $html = <<<END
        <!DOCTYPE html>
        <html lang="fr">
            <head>
                <meta charset="UTF-8">
                <meta http-equiv="X-UA-Compatible" content="IE=edge">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>NutriFit</title>
                <link rel="stylesheet" href="$BaseUrl/style/main.css">
            </head>
            <body>
                <form action="$BaseUrl/requestCreerPlat" method="POST">
                <label for="nom">Nom du plat:</label>
                <input type="text" id="nom" name="nom" requiredminlength="1" maxlength="80" size="10">
                <label for="energie">Energie(kcal):</label>
                <input type="text" id="energie" name="energie" requiredminlength="0" maxlength="5" size="10">
                <label for="lipides">Lipides(g):</label>
                <input type="text" id="lipides" name="lipides" requiredminlength="0" maxlength="5" size="10">
                <label for="glucides">Glucides(g):</label>
                <input type="text" id="glucides" name="glucides" requiredminlength="0" maxlength="5" size="10">
                <label for="proteines">Proteines(g):</label>
                <input type="text" id="proteines" name="proteines" requiredminlength="0" maxlength="5" size="10">
                
                <button type="submit">Creer le plat</button>
                </form>
            </body>
        </html>   
        </html>
        END ;

        return $html;
    }
}