<?php

namespace App\Mail\Frontend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class RegisterSuccess extends Mailable
{
    use Queueable, SerializesModels;

    public $data = '';

    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $viewData = [
            'data' => $this->data
        ];
        return $this
            ->subject(trans('messages.mail_register_success'))
            ->text('frontend.auth.register')
            ->with($viewData);
    }
}
