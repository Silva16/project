<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class ProjectTag extends Model {

    protected $table = 'project_tag';

    //






    /*public static function add($project){

        $id = DB::table('projects')->insertGetId(
            ['name' => $project->name, 'acronym' => $project->acronym, 'description' => $project->description,
            'created_by' => $project->created_by, 'finished_at' ]
        );

        return $id;
    }*/
}