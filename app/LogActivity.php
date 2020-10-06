<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class LogActivity extends Model
{
    protected $fillable = [
        'projects_id', 'activity', 'activity_icon'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projects_id', 'id');
    }
}
