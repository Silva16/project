<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model {

    public $timestamps = false;

    protected $table = 'tags';

    public function projects(){
        return $this->belongsToMany('App\Projects');
    }

}
