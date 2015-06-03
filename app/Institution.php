<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model {

    protected $table = 'institutions';

    public function projects(){
        return $this->belongsToMany('App\Project');
    }

}
