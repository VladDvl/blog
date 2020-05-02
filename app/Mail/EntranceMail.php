<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\groups;
use App\User;

class EntranceMail extends Mailable
{
    use Queueable, SerializesModels;

    public $group;
    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(groups $group, User $user)
    {
        $this->group = $group;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.entrance-email');
    }
}
