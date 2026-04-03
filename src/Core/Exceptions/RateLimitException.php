<?php

namespace Believe\Core\Exceptions;

/**
  *
  *
 */
class RateLimitException extends APIStatusException
{
  /** @var string */
  protected const DESC = 'Believe Rate Limit Exception';
}