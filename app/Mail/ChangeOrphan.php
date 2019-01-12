<?php

namespace App\Mail;

use App\Models\Orphan;
use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ChangeOrphan extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Orphan
     */
    public $orphan;

    /**
     * @var User
     */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param Orphan $orphan
     * @param User $user
     */
    public function __construct(Orphan $orphan, User $user)
    {
        $this->orphan = $orphan;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to($this->user->email)
            ->from(env('MAIL_SENDER_EMAIL'))
            ->view('emails.change_orphan')
            ->subject(config('app.name'));
    }
}
