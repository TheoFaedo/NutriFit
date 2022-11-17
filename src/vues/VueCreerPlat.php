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
                <div id="corp">
                    <div class="illot" style="text-align:center; margin-top: 40%">
                        <div class="titre">Créer un plat</div>
                        <form action="$BaseUrl/requestCreerPlat" method="POST">
                            <label for="energie">Nom du plat:</label>
                            <input type="text" id="nom" name="nom" requiredminlength="1" maxlength="80" size="10" placeholder="Nom du plat">
                            <label for="lipides" style="margin-top:15px;">Energie(kcal):</label>
                            <input type="number" id="energie" name="energie" requiredminlength="1" maxlength="5" size="10" placeholder="Energie(kcal)">
                            <label for="lipides">Lipides(g):</label>
                            <input type="text" id="lipides" name="lipides" requiredminlength="0" maxlength="5" size="10" placeholder="Lipides(g)">
                            <label for="glucides">Glucides(g):</label>
                            <input type="text" id="glucides" name="glucides" requiredminlength="0" maxlength="5" size="10" placeholder="Glucides(g)">
                            <label for="proteines">Proteines(g):</label>
                            <input type="text" id="proteines" name="proteines" requiredminlength="0" maxlength="5" size="10" placeholder="Proteines(g)">
                            
                            <button type="submit1" style="margin-top:15px; min-width: 80%; font-size: 18px">Creer le plat</button>
                        </form>    
                    </div>
                </div>
            </body>
        </html>   
        </html>
        END ;

        return $html;
    }
}