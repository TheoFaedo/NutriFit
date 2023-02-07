<?php
namespace app\vues;

use app\autres\CoeficientX;
use app\autres\EquationCourbe;
use app\autres\FonctionsUtiles;
use app\autres\ModeleCourbe;

/**
 * Classe mere de toute les vues contenant toutes les 
 */
class Vue{

    private $rq;

    public function __construct($rq){
        $this->rq = $rq;
    }

    protected function getFooter($selectedIndex, $BaseUrl){
        $tab = ["img_inactive", "img_inactive", "img_inactive"];
        $tab[$selectedIndex] = "img_active";
        return <<<HTML
        <div id="footbar">
            <div class="footbar_button"><img src="$BaseUrl/img/clipboard.png" alt="une image de callepin représentant le menu d'ajout journalier" class="{$tab[0]}">journal</div>
            <div class="footbar_button"><img src="$BaseUrl/img/user.png" alt="une image de personnage representant le menu profil" class="{$tab[1]}">profil</div>
            <div class="footbar_button"><img src="$BaseUrl/img/shallow-pan-of-food.png" alt="une image toque de cuisinier représentant le menu de création doe plats" class="{$tab[2]}">créer un plat</div>
        </div>
        HTML;
    }

    protected function getHeader(){
        return `<div id="bar"><div>Nutrifit</div></div>`;
    }
}