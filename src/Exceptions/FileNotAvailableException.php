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
    public const MESSAGE = 'Управляющий файл monit не найден.';
    public const CODE = 404;
}
