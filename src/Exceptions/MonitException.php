<?php

namespace Scaleplan\Monit\Exceptions;

/**
 * Class MonitException
 *
 * @package Scaleplan\Monit\Exceptions
 */
class MonitException extends \Exception
{
    public const MESSAGE = 'Monit error.';

    /**
     * MonitException constructor.
     *
     * @param string $message
     * @param int $code
     * @param \Throwable|null $previous
     */
    public function __construct(string $message = '', int $code = 0, \Throwable $previous = null)
    {
        parent::__construct($message ?: static::MESSAGE, $code, $previous);
    }
}
