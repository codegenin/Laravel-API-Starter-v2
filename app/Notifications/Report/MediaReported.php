<?php

namespace App\Notifications\Report;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MediaReported extends Notification implements ShouldQueue
{
    use Queueable;
    /**
     * @var
     */
    private $media;
    /**
     * @var
     */
    private $user;
    
    /**
     * Create a new notification instance.
     *
     * @param $media
     * @param $user
     */
    public function __construct($media, $user)
    {
        //
        $this->media = $media;
        $this->user  = $user;
    }
    
    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }
    
    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Alert! An image has been reported')
            ->line("Reported by {$this->user->name} with email {$this->user->email}")
            ->action('View Media', url("{$this->media->getUrl()}"))
            ->line('Thank you!');
    }
    
    /**
     * Get the array representation of the notification.
     *
     * @param  mixed $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
