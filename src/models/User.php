<?php
namespace app\models;

class User extends \Illuminate\Database\Eloquent\Model{

    public $timestamps = false;
    protected $table = 'user';
    protected $primaryKey = 'id_user';

}