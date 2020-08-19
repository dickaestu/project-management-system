<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ProjectMember extends Model
{
    protected $fillable = [
        'projects_id', 'users_id', 'role_member'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class, 'projects_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
}
