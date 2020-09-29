<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SubTask extends Model
{
    protected $fillable = ['board_tasks_id', 'sub_task_name', 'sub_task_status'];


    public function board_task()
    {
        return $this->belongsTo(BoardTask::class, 'board_tasks_id', 'id');
    }
}
