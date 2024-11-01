<?php

namespace App\Exceptions;

use Illuminate\Auth\AuthenticationException;

/**
 * Class ReportableException.
 */
class AuthenticateSessionException extends AuthenticationException
{
    public function __construct($message = 'Unauthenticated.', array $guards = [], $redirectTo = null)
    {
        parent::__construct($message, $guards, $redirectTo);
    }
}
