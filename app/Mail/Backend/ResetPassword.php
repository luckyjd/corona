<?php

namespace App\Mail\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $hash = '';
    public $user = '';

    public function __construct($hash, $user)
    {
        $this->hash = $hash;
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $link = str_replace_first('?', '/', route('backend.password.reset', $this->hash));
        return $this
            ->subject(trans('messages.mail_reset_password'))
            ->text('backend.auth.password.email_' . getCurrentLangCode())
            ->with(['link' => $link, 'name' => $this->user->name]);
    }
}
