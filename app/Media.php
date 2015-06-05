<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    protected $table = 'media';

    public function project(){
        return $this->belongsTo('App\Project');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

}
