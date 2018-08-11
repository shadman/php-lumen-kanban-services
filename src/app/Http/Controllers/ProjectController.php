<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Facade\ProjectFacade;
use App\Validators\ProjectValidator;


class ProjectController extends Controller
{

    /**
     * Create project
     * 
     * @param  \App\Models\Project $request 
     * @return json
     */
    public function create(Request $request){

        $parameters = $request->json()->all();

        $validator = ProjectValidator::create($parameters, $request->auth->id);
        if (!$validator->fails()) {
            return ProjectFacade::create($parameters, $request->auth->id);
        }

        // Bad Request response
        return response()->json('Input validation failed', HttpResponse::HTTP_BAD_REQUEST);
        
    }

    /**
     * List of projects
     * 
     * @param  \App\Models\Project $request 
     * @return json
     */
    public function list(Request $request){

        $role = $request->input('role');
        return ProjectFacade::list($role, $request->auth->id);
    }


    /**
     * Get specific project results
     * 
     * @param  \App\Models\Project $request 
     * @return json
     */
    public function get(Request $request, $projectId){
        return ProjectFacade::get($projectId, $request->auth->id);
    }

}
