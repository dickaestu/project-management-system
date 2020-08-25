<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BoardTask extends Model
{
    protected $fillable = [
        'boards_id', 'task_name', 'task_description', 'due_date'
    ];

    public function board()
    {
        return $this->belongsTo(Board::class, 'boards_id', 'id');
    }
}
