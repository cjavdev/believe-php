<?php

namespace Believe\Core\Exceptions;

class NotFoundException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Believe Not Found Exception';
}
