<?php

namespace App\Mail\Frontend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CongratsCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $data = '';

    public function __construct( $data)
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
            ->subject(trans('messages.mail_congrats_customer'))
            ->text('frontend.applications.congrats.congrats_customer')
            ->with($viewData);
    }
}
