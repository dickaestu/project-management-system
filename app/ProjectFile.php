<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class ProjectFile extends Model
{
    use SoftDeletes;
    protected $fillable = ['projects_id', 'file_name'];


    public function project()
    {
        return $this->belongsTo(Project::class, 'projects_id', 'id');
    }
}
