<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class InviteAlumni extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this->subject('Complete Your Registration')
                    ->view('emails.invite-alumni')
                    ->with([
                        'name' => $this->user->name,
                        'registrationLink' => route('register.complete', ['email' => $this->user->email])
                    ]);
    }
}
