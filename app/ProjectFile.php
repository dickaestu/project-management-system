<?php

namespace App;

use Illuminate\Database\Eloquent\Model;



class ProjectFile extends Model
{
    protected $fillable = ['projects_id', 'file_name'];


    public function project()
    {
        return $this->belongsTo(Project::class, 'projects_id', 'id');
    }
}
