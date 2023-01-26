<?php
namespace app\vues;

use app\autres\CoeficientX;
use app\autres\EquationCourbe;
use app\autres\FonctionsUtiles;
use app\autres\ModeleCourbe;

use app\models\User;

class VueProfil extends Vue{

    private $rq, $user_data;

    public function __construct($rq, $user_data){
        $this->rq = $rq;
        $this->user_data = $user_data;
    }

    public function render(){

        $BaseUrl = $this->rq->getUri()->getBasePath();

        $html = <<<HTML
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
                    <div id="bar"><div>Nutrifit</div></div>
                    <div id="content">
                        <div class="illot" style="text-align:center; font-size: 20px">
                            Connecté(e) en tant que <b>{$this->user_data->pseudo}</b>
                            <form action="$BaseUrl/deconnexionRedirect" method="GET"><button type="submit" id="bouton_deco" style="margin-top:15px; min-width: 80%; font-size: 18px">Deconnexion</button></form>
                        </div>
                        <div class="illot" style="text-align:center; margin-top: 10%; margin-bottom: auto">
                            <div class="titre" style="margin-bottom: 20px;">Changer Objectif</div>

                                <div class="form_component" style="display: grid; grid-template-columns: 1fr 1fr 1fr 1fr;">
                                    <div class="form_component"><label for="energie">Energie(kcal):</label><input type="number" value="{$this->user_data->oj_energie}" id="energie" name="energie" requiredminlength="1" maxlength="5" size="10" placeholder="Energie(kcal)"></div>
                                    <div class="form_component"><label for="lipides">Lipides(g):</label><input type="number" min="0" value="{$this->user_data->oj_lipides}" id="lipides" name="lipides" requiredminlength="0" maxlength="5" size="10" placeholder="Lipides(g)"></div>
                                    <div class="form_component"><label for="glucides">Glucides(g):</label><input type="number" min="0" value="{$this->user_data->oj_glucides}" id="glucides" name="glucides" requiredminlength="0" maxlength="5" size="10" placeholder="Glucides(g)"></div>
                                    <div class="form_component"><label for="proteines">Proteines(g):</label><input type="number" min="0" value="{$this->user_data->oj_proteines}" id="proteines" name="proteines" requiredminlength="0" maxlength="5" size="10" placeholder="Proteines(g)"></div>
                                </div>
                                <button id="bouton_obj" style="margin-top:15px; min-width: 80%; font-size: 18px">Confirmer le changement</button>
                            
                        </div>
                    </div>
                    {$this->getFooter(1, $BaseUrl)}
                </div>
            </body>
        </html>   
        <script src="$BaseUrl/js/main.js"></script>
        <script src="$BaseUrl/js/profil.js"></script>
        HTML ;

        return $html;
    }
}