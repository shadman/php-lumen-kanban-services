<?php

namespace App\Facade;

use Illuminate\Http\Response as HttpResponse;
use App\Models\Project;

class ProjectFacade
{

    public static function create($parameters, $userId)
    {
	    $createdProject = Project::create_record($parameters, $userId);
	    if($createdProject) $createdProject = Project::project($createdProject->id, $userId);

	    return response()->json($createdProject, HttpResponse::HTTP_CREATED);
    }


    public static function get($projectId, $userId)
    {
	    $project = Project::project($projectId, $userId);
	    if(Project::is_project_access_allowed($projectId, $userId)) {
	    	if ($project) return response()->json($project, HttpResponse::HTTP_OK);
	    	else {
			    // Bad Request response
		        return response()->json('Invalid ID supplied', HttpResponse::HTTP_BAD_REQUEST);
	    	}
	    }

		// Unauthorized Request response
        return response()->json('Permission denied for the current User', HttpResponse::HTTP_UNAUTHORIZED);
    }


	public static function list($role, $userId)
    {
	    $project = Project::list($role, $userId);
    	if ($project) return response()->json($project, HttpResponse::HTTP_OK);
    	else {
		    // Bad Request response
	        return response()->json('Invalid ID supplied', HttpResponse::HTTP_BAD_REQUEST);
    	}

		// Unauthorized Request response
        return response()->json('Permission denied for the current User', HttpResponse::HTTP_UNAUTHORIZED);
    }

}
