<?php

namespace Believe\Core\Exceptions;

class BadRequestException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Believe Bad Request Exception';
}
