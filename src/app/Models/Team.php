<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Team extends Model
{

    protected $fillable = ['projectId', 'userId'];
    public $timestamps = false;

    /**
     * Add a member
     */
    static public function add_member($projectId, $userId) {
        return self::create(
            array(
                'projectId' => $projectId,
                'userId' => $userId,
                'createdAt' => Carbon::now()->toDateTimeString(),
            )
        );   
    }

    /**
     * Delete a member
     */
    static public function delete_member($projectId, $userId) {
        $member = self::where('projectId', $projectId)->where('userId', $userId)->first();
        $member->delete(); 
    }
    
    
}
