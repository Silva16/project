<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Comments extends Model {

    protected $table = 'comments';

    public function users(){
        return $this->belongsTo('App/User');
    }
    public function projects(){
        return $this->belongsTo('App/Projects');
    }

}
