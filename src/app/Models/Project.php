<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use App\Models\Team;

class Project extends Model
{

    protected $fillable = ['name', 'creator', 'role', 'team', 'creator'];
    public $timestamps = false;

    /**
     * Get the creator record associated with the project.
     */
    public function creator()
    {
        return $this->hasOne('App\Models\User', 'id', 'creator');
    }

    /**
     * Get all memebers associated with the project.
     */
    public function team()
    {
       return $this->belongsToMany('App\Models\User', 'teams', 'projectId', 'userId');
    }

    /**
     * Create project
     */
    static public function create_record($parameters, $userId) {
        $project = self::create(
            array(
                'name' => $parameters['name'],
                'createdAt' => Carbon::now()->toDateTimeString(),
                'creator' => $userId
            )
        );

        if($project)
            $team = new Team;
            $team->add_member($project->id, $userId);

        return $project;
    }


    /**
     * Get specific project details
     */
    static public function project($id, $userId){
        $data = Project::where('id', $id)->with('creator')->with('team')->first();
        if ($data) {
            if ($data->creator == $userId) $data->role = 'creator';
            else $data->role = 'member';
        }
        return $data;
    }


    /**
     * Is project allowed for specific user
     */
    static public function is_project_access_allowed($projectId, $userId) {
        return Team::where('userId', $userId)->where('projectId', $projectId)->first();
    }
    

    /**
     * get project list, as a member, creator and all
     */
    static public function list($role, $userId){
        $projectIds = Team::select('projectId')->where('userId', $userId)->get();
        
        # creator
        if ($projectIds && $role==config('app.roles.creator')) {
            $data = Project::whereIn('id', $projectIds)->where('creator', $userId)->with('creator')->with('team')->get();

        # member
        } else if ($projectIds && $role==config('app.roles.member')) {
            $data = Project::whereIn('id', $projectIds)->where('creator', '<>', $userId)->with('creator')->with('team')->get();

        # all
        } else { 
            $data = Project::whereIn('id', $projectIds)->with('creator')->with('team')->get();
        } 

        return $data;
    }

}
