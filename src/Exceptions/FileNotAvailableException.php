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
    public const MESSAGE = 'Monit control file not available';
    public const CODE = 404;
}
