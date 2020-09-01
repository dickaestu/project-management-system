<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'project_logo', 'project_name', 'client_name', 'project_manager', 'start', 'end', 'description', 'project_status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'project_manager', 'id');
    }

    public function projectFile()
    {
        return $this->hasMany(ProjectFile::class, 'projects_id', 'id');
    }

    public function project_member()
    {
        return $this->hasMany(ProjectMember::class, 'projects_id', 'id');
    }
}
