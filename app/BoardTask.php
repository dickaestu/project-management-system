<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardTask extends Model
{
    protected $fillable = [
        'boards_id', 'task_name', 'task_description', 'due_date', 'start_date', 'status_task'
    ];

    public function board()
    {
        return $this->belongsTo(Board::class, 'boards_id', 'id');
    }

    public function task_member()
    {
        return $this->hasMany(TaskMember::class, 'board_tasks_id', 'id');
    }
}
