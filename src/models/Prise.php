<?php
namespace app\models;

class Prise extends \Illuminate\Database\Eloquent\Model{

    public $timestamps = false;
    protected $table = 'prise';
    protected $primaryKey = 'id_prise';

    public function plat(){
        return $this->belongsTo('app\models\Plat', 'plat');
    }

}