<?php

namespace App\Mail\Frontend;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CongratsAdmin extends Mailable
{
    use Queueable, SerializesModels;

    protected $_data = '';

    public function __construct( $data)
    {
        $this->_data = $data;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $viewData = [
            'data' => $this->_data
        ];
        return $this
            ->subject(trans('messages.mail_congrats_admin'))
            ->text('frontend.applications.congrats.congrats_admin')
            ->with($viewData);
    }
}
