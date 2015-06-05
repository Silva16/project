<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Project extends Model {

    protected $table = 'projects';

    //
    public function users(){
        return $this->belongsToMany('App\User');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function medias(){
        return $this->hasMany('App\Media');
    }





    /*public static function add($project){

        $id = DB::table('projects')->insertGetId(
            ['name' => $project->name, 'acronym' => $project->acronym, 'description' => $project->description,
            'created_by' => $project->created_by, 'finished_at' ]
        );

        return $id;
    }*/
}