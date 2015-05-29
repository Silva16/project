<?php namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class Project extends Model {


    private $id;
    private $name;
    private $acronym;
    private $description;
    private $type;
    private $theme;
    private $keywords;
    private $started_at;
    private $finished_at;
    private $created_by;
    private $update_by;
    private $approved_by;
    private $used_software;
    private $used_hardware;
    private $observations;
    private $featured_until;
    private $replaces_id;
    private $state;
    private $refusal_msg;
    private $deleted_at;
    private $created_at;
    private $update_at;

    function __construct(
        $acronym = null,
        $approved_by = null,
        $created_at = null,
        $created_by = null,
        $deleted_at = null,
        $description = null,
        $featured_until = null,
        $finished_at = null,
        $id = null,
        $keywords = null,
        $name = null,
        $observations = null,
        $refusal_msg = null,
        $replaces_id = null,
        $started_at = null,
        $state = null,
        $theme = null,
        $type = null,
        $update_at = null,
        $update_by = null,
        $used_hardware = null,
        $used_software = null
    ) {
        $this->acronym = $acronym;
        $this->approved_by = $approved_by;
        $this->created_at = $created_at;
        $this->created_by = $created_by;
        $this->deleted_at = $deleted_at;
        $this->description = $description;
        $this->featured_until = $featured_until;
        $this->finished_at = $finished_at;
        $this->id = $id;
        $this->keywords = $keywords;
        $this->name = $name;
        $this->observations = $observations;
        $this->refusal_msg = $refusal_msg;
        $this->replaces_id = $replaces_id;
        $this->started_at = $started_at;
        $this->state = $state;
        $this->theme = $theme;
        $this->type = $type;
        $this->update_at = $update_at;
        $this->update_by = $update_by;
        $this->used_hardware = $used_hardware;
        $this->used_software = $used_software;
    }

    //
    public function user(){
        return $this->belongsTo('App/User', 'local_key');
    }





    /*public static function add($project){

        $id = DB::table('projects')->insertGetId(
            ['name' => $project->name, 'acronym' => $project->acronym, 'description' => $project->description,
            'created_by' => $project->created_by, 'finished_at' ]
        );

        return $id;
    }*/
}