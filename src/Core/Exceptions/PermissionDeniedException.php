<?php

namespace Believe\Core\Exceptions;

class PermissionDeniedException extends APIStatusException
{
    /** @var string */
    protected const DESC = 'Believe Permission Denied Exception';
}
