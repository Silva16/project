<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Institutions extends Model {

    protected $table = 'institutions';

    public function projects(){
        return $this->belongsToMany('App/Project');
    }

}
