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
        return <<<END
        <div id="footbar">
            <div class="footbar_button"><img/ src="$BaseUrl/img/clipboard.png" class="{$tab[0]}">journal</div>
            <div class="footbar_button"><img/ src="$BaseUrl/img/user.png" class="{$tab[1]}">profil</div>
            <div class="footbar_button"><img/ src="$BaseUrl/img/shallow-pan-of-food.png" class="{$tab[2]}">créer un plat</div>
        </div>
        END;
    }

    protected function getHeader(){
        return `<div id="bar"><div>Nutrifit</div></div>`;
    }
}