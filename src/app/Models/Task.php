<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Task extends Model
{

    protected $fillable = ['title', 'description', 'status', 'projectId'];
    public $timestamps = false;

    /**
     * Create task
     */
    static public function create_record($parameters, $projectId) {
        $task = self::create(
            array(
                'title' => $parameters['title'],
                'description' => $parameters['description'],
                'status' => $parameters['status'],
                'projectId' => $projectId,
                'createdAt' => Carbon::now()->toDateTimeString(),
                'updatedAt' => Carbon::now()->toDateTimeString(),
            )
        );

        return $task;
    }

    /**
     * Update task
     */
    static public function update_record($parameters, $projectId, $taskId) {
        $task = self::where('id', $taskId)->first();
        if ($task){
				$task->title = $parameters['title'];
				$task->description = $parameters['description'];
				$task->status = $parameters['status'];
				$task->projectId = $projectId;
				$task->updatedAt = Carbon::now()->toDateTimeString();
				$task->save();
        }
        return $task;
    }

    /**
     * List of tasks for a project
     */
    static public function list($projectId) {
    	return self::where('projectId', $projectId)->get();
    }

}
