<?php

namespace App\Facade;

use Illuminate\Http\Response as HttpResponse;
use App\Models\Task;
use App\Models\Project;

class TaskFacade
{

    /**
     * create task logics
     */
    public static function create($parameters, $projectId, $userId)
    {
    	$project = Project::where('id', $projectId)->first();
		if($project) {

			if(Project::is_project_access_allowed($projectId, $userId)) {

			    $createdTask = Task::create_record($parameters, $projectId);
			    if ($createdTask) return response()->json($createdTask, HttpResponse::HTTP_CREATED);

				// Bad Request response
				return response()->json('Invalid ID supplied', HttpResponse::HTTP_BAD_REQUEST);
			} 

			// Unauthorized Request response
	        return response()->json('Permission denied for the current User', HttpResponse::HTTP_UNAUTHORIZED);

		}

	    // Not Found response
	    return response()->json('Project not found', HttpResponse::HTTP_NOT_FOUND);
    }

    /**
     * uppdate task logics
     */
    public static function update($parameters, $projectId, $taskId, $userId)
    {
    	$project = Project::where('id', $projectId)->first();
		if($project) {

			if(Project::is_project_access_allowed($projectId, $userId)) {

			    $updatedTask = Task::update_record($parameters, $projectId, $taskId);
			    if ($updatedTask) { return response()->json($updatedTask, HttpResponse::HTTP_OK); }

			    // Bad Request response
			    return response()->json('Invalid ID supplied', HttpResponse::HTTP_BAD_REQUEST);
			} 

			// Unauthorized Request response
	        return response()->json('Permission denied for the current User', HttpResponse::HTTP_UNAUTHORIZED);

		}

	    // Not Found response
	    return response()->json('Project not found', HttpResponse::HTTP_NOT_FOUND);
    }


    /**
     * list of all tasks for a project logics
     */
    public static function list($projectId, $userId)
    {
		$project = Project::where('id', $projectId)->first();
		if($project) {

			if(Project::is_project_access_allowed($projectId, $userId)) {

			    $taskList = Task::list($projectId);
			    if ($taskList) { return response()->json($taskList, HttpResponse::HTTP_OK); }

			    // Bad Request response
			    return response()->json('Invalid ID supplied', HttpResponse::HTTP_BAD_REQUEST);
			} 

			// Unauthorized Request response
	        return response()->json('Permission denied for the current User', HttpResponse::HTTP_UNAUTHORIZED);

		}

	    // Not Found response
	    return response()->json('Project not found', HttpResponse::HTTP_NOT_FOUND);
    }

}
