<?php

namespace App\Facade;

use Illuminate\Http\Response as HttpResponse;
use App\Models\Project;
use App\Models\Team;
use App\Models\User;

class ProjectTeamFacade
{

    public static function add($projectId, $userId, $loggedInUserId)
    {
		$project = Project::where('id', $projectId)->first();
		if($project) {

		    if(Project::is_project_access_allowed($projectId, $loggedInUserId)) {

	    		$user = User::where('id', $userId)->first(); 
	    		if($user) { 
		    		$teamMember = Team::add_member($projectId, $userId);
		    		return response()->json($user, HttpResponse::HTTP_OK);
		    	}

		    	# Bag Request response
	    		return response()->json('Invalid parameters supplied', HttpResponse::HTTP_BAD_REQUEST);
		    } 

			// Unauthorized Request response
	        return response()->json('Permission denied for the current User', HttpResponse::HTTP_UNAUTHORIZED);
    	}

	    // Not Found response
	    return response()->json('Project not found', HttpResponse::HTTP_NOT_FOUND);
    }


    public static function list($projectId, $loggedInUserId)
    {
		$project = Project::where('id', $projectId)->first();
		if($project) {
			
			if(Project::is_project_access_allowed($projectId, $loggedInUserId)) {
				$teamIds = Team::select('userId')->where('projectId', $projectId)->get();
				$members = User::whereIn('id', $teamIds)->get();
				return response()->json($members, HttpResponse::HTTP_OK);
			}

			// Unauthorized Request response
	        return response()->json('Permission denied for the current User', HttpResponse::HTTP_UNAUTHORIZED);
		} 

	    // Not Found response
	    return response()->json('Project not found', HttpResponse::HTTP_NOT_FOUND);
    }


    public static function delete($projectId, $userId, $loggedInUserId)
    {
		$project = Project::where('id', $projectId)->first();
		if($project) {

		    if(Project::is_project_access_allowed($projectId, $loggedInUserId)) {

	    		$user = Team::where('projectId', $projectId)->where('userId', $userId)->first();
	    		if($user) { 
	    			$userData = User::where('id', $userId)->first(); 
		    		Team::delete_member($projectId, $userId);
		    		return response()->json($userData, HttpResponse::HTTP_OK);
		    	}

		    	# Bag Request response
	    		return response()->json('Invalid parameters supplied', HttpResponse::HTTP_BAD_REQUEST);
		    } 

			// Unauthorized Request response
	        return response()->json('Permission denied for the current User', HttpResponse::HTTP_UNAUTHORIZED);
    	}

	    // Not Found response
	    return response()->json('Project not found', HttpResponse::HTTP_NOT_FOUND);
    }
}
