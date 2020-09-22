<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class TaskFile extends Model
{
    protected $fillable = ['board_tasks_id', 'file_name', 'file_path'];


    public function board_task()
    {
        return $this->belongsTo(BoardTask::class, 'board_tasks_id', 'id');
    }
}
