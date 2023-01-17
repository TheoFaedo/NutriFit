<?php
namespace app\vues;

use app\autres\CoeficientX;
use app\autres\EquationCourbe;
use app\autres\FonctionsUtiles;
use app\autres\ModeleCourbe;

class VueCreerPlat extends Vue{

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
                <div id="corp" class="corp_creerplat">
                    <div id="bar"><div>Nutrifit</div></div>
                    <div class="illot" style="text-align:center; margin-top: 20%; margin-bottom: auto">
                        <div class="titre" style="margin-bottom: 20px;">Créer un plat</div>
                        <form action="$BaseUrl/requestCreerPlat" method="POST">
                            <div class="form_component"><label for="energie">Nom du plat:</label><input type="text" id="nom" name="nom" requiredminlength="1" maxlength="80" size="10" placeholder="Nom du plat"></div>
                            <div class="form_component"><label for="lipides" style="margin-top:15px;">Energie(kcal):</label><input type="number" value="0" id="energie" name="energie" requiredminlength="1" maxlength="5" size="10" placeholder="Energie(kcal)"></div>
                            <div class="form_component" style="display: grid; grid-template-columns: 1fr 1fr 1fr;">
                                <div class="form_component"><label for="lipides">Lipides(g):</label><input type="number" min="0" value="0" class="small_input" id="lipides" name="lipides" requiredminlength="0" maxlength="5" size="10" placeholder="Lipides(g)"></div>
                                <div class="form_component"><label for="glucides">Glucides(g):</label><input type="number" min="0" value="0" class="small_input" id="glucides" name="glucides" requiredminlength="0" maxlength="5" size="10" placeholder="Glucides(g)"></div>
                                <div class="form_component"><label for="proteines">Proteines(g):</label><input type="number" min="0" value="0" class="small_input" id="proteines" name="proteines" requiredminlength="0" maxlength="5" size="10" placeholder="Proteines(g)"></div>
                            </div>
                            <button type="submit" style="margin-top:15px; min-width: 80%; font-size: 18px">Créer le plat</button>
                        </form>    
                    </div>
                    {$this->getFooter(2, $BaseUrl)}
                </div>
            </body>
        </html>   
        <script src="$BaseUrl/js/main.js"></script>
        <script src="$BaseUrl/js/creerPlat.js"></script>
        END ;

        return $html;
    }
}