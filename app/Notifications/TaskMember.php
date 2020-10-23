<?php

namespace App\Notifications;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use App\TaskMember as TaskMemberModel;

class TaskMember extends Notification
{
    use Queueable;
    public $taskMember;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(TaskMemberModel $taskMember)
    {
        $this->task_member = $taskMember;
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
            'projects_id' => $this->task_member->project_members->projects_id,
            'users_id' => $this->task_member->project_members->users_id,
            'icon' => "fas fa-clipboard-list",
            'message' => "You have been assigned to " . $this->task_member->board_task->task_name . " Task in " . $this->task_member->project_members->project->project_name . " Project",
            'status' => "added-to-task",
        ];
    }

    public function toBroadcast($notifiable)
    {
        return [
            'data' => [
                'projects_id' => $this->task_member->project_members->projects_id,
                'users_id' => $this->task_member->project_members->users_id,
                'icon' => "fas fa-clipboard-list",
                'message' => "You have been assigned to " . $this->task_member->board_task->task_name . " Task in " . $this->task_member->project_members->project->project_name . " Project",
                'status' => "added-to-task",
            ],
            'created_at' => Carbon::now()->diffForHumans(),
            'read_at' => null,
        ];
    }
}
