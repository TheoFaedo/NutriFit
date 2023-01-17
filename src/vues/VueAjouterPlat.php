<?php
namespace app\vues;

use app\autres\CoeficientX;
use app\autres\EquationCourbe;
use app\autres\FonctionsUtiles;
use app\autres\ModeleCourbe;

class VueAjouterPlat extends Vue{

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
                <div id=corp class="corp_enregistrerprise">
                    <div id="bar"><div>Nutrifit</div></div>
                    <div class="illot">
                        <div class="titre">Ajouter Prise</div>
                        <select name="plats" id="plat-select">
                            <option value="">Choisissez un plat</option>
                        </select>
                        <button onclick="ajouterPrise()">Ajouter</button>
                        <div id="val-nut" class="aff_vn">
                            <div class="nut_component"><div class="t_vnut">energie</div><span class="valn">---</span>kcal</div>
                            <div class="nut_component"><div class="t_vnut">lipides</div><span class="valn">---</span>g</div>
                            <div class="nut_component"><div class="t_vnut">glucides</div><span class="valn">---</span>g</div>
                            <div class="nut_component"><div class="t_vnut">proteines</div><span class="valn">---</span>g</div>
                        </div>
                    </div>
                    <div class="illot" style="background-color:var(--color2); font-size: 17px; overflow-y: scroll;">
                        <div class="titre">Liste prises du jour</div>
                        <ul id="liste_prises">
                        
                        </ul>
                    </div>
                    <div class="illot">
                        <div class="titre" style="float:down">Objectif journalier</div>
                        <div class="aff_vn">
                            <div class="nut_component"><div class="t_vnut">energie</div><span class="prog">---</span><br>/<span class="obj">---</span>kcal</div>
                            <div class="nut_component"><div class="t_vnut">lipides</div><span class="prog">---</span><br>/<span class="obj">---</span>g</div>
                            <div class="nut_component"><div class="t_vnut">glucides</div><span class="prog">---</span><br>/<span class="obj">---</span>g</div>
                            <div class="nut_component"><div class="t_vnut">proteines</div><span class="prog">---</span><br>/<span class="obj">---</span>g</div>
                        </div>
                    </div>
                    {$this->getFooter(0, $BaseUrl)}
                </div>
            </body>
        </html>
        <script src="$BaseUrl/js/main.js"></script>
        <script src="$BaseUrl/js/ajouterPrise.js"></script>
        END ;

        return $html;
    }

}