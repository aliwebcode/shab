<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\BroadcastMessage;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class ImageSendNotification extends Notification implements ShouldQueue
{
    use Queueable;

    public $image;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($image)
    {
        $this->image = $image;
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
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toDatabase($notifiable)
    {
        return [
            'sender' => User::findOrFail($this->image->from_id),
            'image' => $this->image->image,
            'created_at' => $this->image->created_at->format('d-m-Y h:i a'),
        ];
    }
    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'data' => [
                'sender' => User::findOrFail($this->image->from_id),
                'image' => $this->image->image,
                'created_at' => $this->image->created_at->format('d-m-Y h:i a'),
            ]
        ]);
    }
}
