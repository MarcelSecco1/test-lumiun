<?php

namespace App\Exceptions;

use Exception;

class ExistDomainException extends Exception
{
    protected $message = 'The domain already exists in the user account';
}
