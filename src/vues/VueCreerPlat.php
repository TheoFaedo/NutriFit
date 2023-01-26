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

        $html =  <<<HTML
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
                    <div id="content">
                        <div class="illot" style="text-align:center;">
                            <div class="titre" style="margin-bottom: 20px;">Créer un plat</div>
                            <form action="$BaseUrl/api/creerPlat" method="POST">
                                <div class="form_component"><label for="energie">Nom du plat:</label><input type="text" id="nom" name="nom" requiredminlength="1" maxlength="80" size="10" placeholder="Nom du plat"></div>
                                <div class="form_component" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr;">
                                    <div class="form_component"><label for="energie">Energie(kcal):</label><input type="number" step="0.1" min="0" id="energie" name="energie" requiredminlength="1" maxlength="5" size="10" placeholder="kcal"></div>
                                    <div class="form_component"><label for="lipides">Lipides(g):</label><input type="number" step="0.1" min="0" id="lipides" name="lipides" requiredminlength="1" maxlength="5" size="10" placeholder="g"></div>
                                    <div class="form_component"><label for="glucides">Glucides(g):</label><input type="number" step="0.1" min="0" id="glucides" name="glucides" requiredminlength="1" maxlength="5" size="10" placeholder="g"></div>
                                    <div class="form_component"><label for="proteines">Proteines(g):</label><input type="number" step="0.1" min="0" id="proteines" name="proteines" requiredminlength="1" maxlength="5" size="10" placeholder="g"></div>
                                </div>
                                <button type="submit" style="margin-top:15px; min-width: 80%; font-size: 18px">Créer le plat</button>
                            </form>    
                        </div>
                        <div class="illot" style="text-align:center;">
                            <div class="titre" style="margin-bottom: 20px;">Utiliser un code barre</div>
                            <button id="boutonPhoto" style="margin-top:15px; min-width: 80%; font-size: 18px"><img src="$BaseUrl/img/camera.png" style="max-height: 70%; width: auto;"></button>
                        </div>
                    </div>
                    {$this->getFooter(2, $BaseUrl)}
                </div>
                <div id="camera" class="cacher"></div>
            </body>
        </html>
        <script src="$BaseUrl/js/main.js"></script>
        <script src="$BaseUrl/js/creerPlat.js"></script>
        <script src="$BaseUrl/js/lib/quagga.min.js"></script>   
        <script src="$BaseUrl/js/lecteur_code_barre.js"></script>
        HTML ;

        return $html;
    }
}