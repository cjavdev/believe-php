<?php

namespace Believe\Core\Exceptions;

class InternalServerException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Believe Internal Server Exception';
}
