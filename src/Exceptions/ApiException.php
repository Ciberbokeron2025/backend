<?php

namespace App\Exceptions;

use App\Constants\Messages;

class ApiException extends \Exception
{
    public function __construct(int $status)
    {
        parent::__construct(Messages::API_ERROR, $status);
    }
}