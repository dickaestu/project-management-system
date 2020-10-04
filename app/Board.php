<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Board extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'projects_id', 'board_name'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projects_id', 'id');
    }

    public function board_task()
    {
        return $this->hasMany(BoardTask::class, 'boards_id', 'id');
    }
}
