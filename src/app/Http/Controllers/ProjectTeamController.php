<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Facade\ProjectTeamFacade;
use App\Validators\ProjectValidator;


class ProjectTeamController extends Controller
{

    /**
     * Add project member
     * 
     * @param  \App\Models\Project $request 
     * @return json
     */
    public function add(Request $request, $projectId, $userId){
        return ProjectTeamFacade::add($projectId, $userId, $request->auth->id);        
    }

    /**
     * List of members for a project
     * 
     * @param  \App\Models\Project $request 
     * @return json
     */
    public function list(Request $request, $projectId){
        return ProjectTeamFacade::list($projectId, $request->auth->id);
    }

    /**
     * Remove a member from specific project
     * 
     * @param  \App\Models\Project $request 
     * @return json
     */
    public function remove(Request $request, $projectId, $userId){
        return ProjectTeamFacade::delete($projectId, $userId, $request->auth->id);
    }

}
