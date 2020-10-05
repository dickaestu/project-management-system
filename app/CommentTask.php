<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CommentTask extends Model
{
    protected $fillable = [
        'board_tasks_id', 'users_id', 'comment'
    ];

    public function board_task()
    {
        return $this->belongsTo(BoardTask::class, 'board_tasks_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
