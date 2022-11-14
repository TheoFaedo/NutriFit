<?php
namespace app\models;

class Plat extends \Illuminate\Database\Eloquent\Model{

    public $timestamps = false;
    protected $table = 'plat';
    protected $primaryKey = 'id_plat';

    public function prises(){
        return $this->hasMany('App\Models\Prise', "id_prise");
    }

}