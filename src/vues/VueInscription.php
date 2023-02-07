<?php
namespace app\vues;

use app\autres\CoeficientX;
use app\autres\EquationCourbe;
use app\autres\FonctionsUtiles;
use app\autres\ModeleCourbe;

class VueInscription extends Vue{

    private $rq, $err;

    public function __construct($rq, $err){
        $this->rq = $rq;
        $this->err = $err;
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
                <div id="corp" class="corp_creerplat">
                    <div id="bar"><div>Nutrifit</div></div>
                    <div id="content">
                        <div class="illot" style="text-align:center; margin-top: 20%; margin-bottom: auto;">
                            <div class="titre" style="margin-bottom: 20px;">Inscription</div>
                            <form action="$BaseUrl/inscriptionRedirect" method="POST">
                                <div class="form_component">
                                    <label for="name">Nom d'utilisateur :</label>
                                    <input class="form_component" id="username" name="username" type="text" placeholder="nom d'utilisateur"></input>
                                </div>
                                <div class="form_component">
                                    <label for="password">Mot de passe :</label>
                                    <input id="password" name="password" type="password" placeholder="mot de passe"></input>
                                </div>
                                <div class="form_component">
                                    <label for="c_password">Confirmer le mot de passe :</label>
                                    <input id="c_password" name="confirm_password" type="password" placeholder="confirmer le mot de passe"></input>
                                </div>
                                <button type="submit" style="margin-top:15px; min-width: 92%; font-size: 18px">S'inscrire</button>
                            </form>    
                            <div class="erreur">{$this->err}</div>
                        </div>
                    </div>
                    {$this->getFooter(1, $BaseUrl)}
                </div>
            </body>
        </html>   
        <script src="$BaseUrl/js/main.js"></script>
        HTML ;

        return $html;
    }
}