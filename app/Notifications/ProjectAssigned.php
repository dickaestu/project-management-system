<?php

namespace App\Notifications;

use App\ProjectMember;
use App\User;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ProjectAssigned extends Notification
{
    use Queueable;
    public $projectMember;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ProjectMember $projectMember)
    {
        $this->project_member = $projectMember;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        // return (new MailMessage)
        //     ->line('The introduction to the notification.')
        //     ->action('Notification Action', url('/'))
        //     ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'projects_id' => $this->project_member->projects_id,
            'users_id' => $this->project_member->users_id,
            'icon' => "fas fa-check",
            'message' => "You are added to " . $this->project_member->project->project_name . " as " . $this->project_member->role_member,
            'status' => "added-to-project",
        ];
    }

    /**
     * Get the broadcastable representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return BroadcastMessage
     */
    public function toBroadcast($notifiable)
    {
        return [
            'data' => [
                'projects_id' => $this->project_member->projects_id,
                'users_id' => $this->project_member->users_id,
                'icon' => "fas fa-check",
                'message' => "You are added to " . $this->project_member->project->project_name . " as " . $this->project_member->role_member,
                'status' => "added-to-project",
            ],
            'created_at' => Carbon::now()->diffForHumans(),
            'read_at' => null,
        ];
    }
}
