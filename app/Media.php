<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model {

    protected $table = 'media';

    public function comments(){
        return $this->belongsTo('App\Project');
    }

}
