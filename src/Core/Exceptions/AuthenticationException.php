<?php

namespace Believe\Core\Exceptions;

class AuthenticationException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Believe Authentication Exception';
}
