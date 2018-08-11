<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response as HttpResponse;
use Illuminate\Http\Request;
use App\Facade\TaskFacade;
use App\Validators\TaskValidator;


class TaskController extends Controller
{
 
    /**
     * Create task
     * 
     * @param  \App\Models\Task $request 
     * @return json
     */
    public function create(Request $request, $projectId){
        $parameters = $request->json()->all();

        $validator = TaskValidator::create_update($parameters);
        if (!$validator->fails()) {
            return TaskFacade::create($parameters, $projectId, $request->auth->id);
        }

        // Bad Request response
        return response()->json('Input validation failed', HttpResponse::HTTP_BAD_REQUEST);
        
    }

    /**
     * Update task
     * 
     * @param  \App\Models\Task $request 
     * @return json
     */
    public function update(Request $request, $projectId, $taskId){
         $parameters = $request->json()->all();

        $validator = TaskValidator::create_update($parameters);
        if (!$validator->fails()) {
            return TaskFacade::update($parameters, $projectId, $taskId, $request->auth->id);
        }

        // Bad Request response
        return response()->json('Input validation failed', HttpResponse::HTTP_BAD_REQUEST);
    }

    /**
     * List of tasks for specific project
     * 
     * @param  \App\Models\Task $request 
     * @return json
     */
    public function list(Request $request, $projectId){
        return TaskFacade::list($projectId, $request->auth->id);
    }

}
