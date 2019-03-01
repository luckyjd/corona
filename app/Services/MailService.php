<?php

namespace App\Services;

use App\Repositories\PresentRepository;
use App\Services\Base\BaseService;

class MailService extends BaseService
{
    public function __construct(PresentRepository $presentRepository)
    {
        $this->setRepository($presentRepository);
    }

    public function sendMail($email = [])
    {
        // @todo to send mail

    }

}