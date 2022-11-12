<?php
namespace app\autres;

use models\Actions;

class FonctionsUtiles{
    
    public static function donnerJourDuMois(){
        return round(date("d")*24+date("H")+((date("i")*60+date("s"))/3600), 3);
    }

    public static function trouverEquationCartesienne($x1, $y1, $x2, $y2){
        $coefdi = ($y2-$y1)/($x2-$x1);
        $k = $coefdi*$x1 - $y1;
    }

    public static function getValeurs($modele){
        $secondes = self::donnerJourDuMois();
        $res = [];
        for($i=0; $i<80; $i++){
            $nb = 80-$i;
            $x = $secondes-$nb*($secondes/80);
            $res[$x] = round($modele->getValeur($x) + 10 * self::fonctionBrouillage($x), 2);
        }
        return $res;
    }

    public static function fonctionBrouillage($x){
        return ($x%5+sin(5*$x))*sin($x)+$x%3-5;
    }

    public static function formaterNombre($number){
        return number_format($number, 2, ',', ' ');
    }

    public static function getValeurActionActuelle($action, $modele){
        $secondes = self::donnerJourDuMois();
        return $modele->getValeur($secondes) + 10 * self::fonctionBrouillage($secondes);
    }
}