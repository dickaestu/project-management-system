<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskMember extends Model
{
    protected $fillable = [
        'board_tasks_id', 'project_members_id'
    ];

    public function board_task()
    {
        return $this->belongsTo(BoardTask::class, 'board_tasks_id', 'id');
    }

    public function project_members()
    {
        return $this->belongsTo(ProjectMember::class, 'project_members_id', 'id');
    }
}
