<?php

namespace Scaleplan\Monit;

use Scaleplan\Monit\Exceptions\MonitException;

/**
 * Class FileNotAvailableException
 *
 * @package Scaleplan\Monit
 */
class FileNotAvailableException extends MonitException
{
    public const MESSAGE = 'monit.monit-file-not-found';
    public const CODE = 404;
}
