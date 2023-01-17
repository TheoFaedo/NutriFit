<?php
namespace app\vues;

use app\autres\CoeficientX;
use app\autres\EquationCourbe;
use app\autres\FonctionsUtiles;
use app\autres\ModeleCourbe;

class VueProfil extends Vue{

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
                    <div class="illot" style="text-align:center; margin-top: 20%; margin-bottom: 20%">
                        <div class="titre" style="margin-bottom: 20px;">Profil</div>
                        <form action="$BaseUrl/requestCreerPlat" method="POST">
                            VueProfil
                        </form>    
                    </div>
                    {$this->getFooter(1, $BaseUrl)}
                </div>
            </body>
        </html>   
        <script src="$BaseUrl/js/main.js"></script>
        END ;

        return $html;
    }
}