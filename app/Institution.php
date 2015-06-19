<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Institution extends Model
{

    protected $table = 'institutions';

    public $timestamps = false;

    public function projects()
    {
        return $this->belongsToMany('App\Project');
    }

    public function users()
    {
        return $this->hasMany('App\Project');
    }

}
