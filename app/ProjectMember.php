<?php

namespace App;

use App\Notifications\ProjectAssigned;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Notification;

class ProjectMember extends Model
{
    use Notifiable;
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

    public function task_member()
    {
        return $this->hasMany(TaskMember::class, 'project_members_id', 'id');
    }

    // Create trigger notification add member to project
    // public static function boot()
    // {
    //     parent::boot();

    //     static::created(function ($model) {
    //         $member = User::findOrFail($model->users_id);
    //         $member->notify(new ProjectAssigned($model));

    //         // This is useful primarily when you need to send a notification to multiple notifiable
    //         // Notification::send($member, new ProjectAssigned($model));
    //     });
    // }
}
