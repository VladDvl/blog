<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class InvoicePaid extends Notification
{
    use Queueable;

    private $author_id;
    private $author_name;
    private $post_slug;
    private $post_title;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($author_id, $author_name, $post_slug, $post_title)
    {
        $this->author_id = $author_id;
        $this->author_name = $author_name;
        $this->post_slug = $post_slug;
        $this->post_title = $post_title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
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
            'message' => 'A new article was created.',
            'author_id' => $this->author_id,
            'author_name' => $this->author_name,
            'post_slug' => $this->post_slug,
            'post_title' => $this->post_title,
          ];
    }
}
