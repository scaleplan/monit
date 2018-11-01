<?php

namespace Scaleplan\Monit;

use Scaleplan\Daemon\Daemon;

/**
 * Class Monit
 *
 * @package Scaleplan\Monit
 */
class Monit
{
    public const MONIT_FILES_PATH = './files';

    public const DAEMON_STARTER_PATH = '/var/www/vendor/bin/daemon';

    /**
     * @var string
     */
    protected $serviceName;

    /**
     * @var string
     */
    protected $processName;

    /**
     * @var string
     */
    protected $filePath;

    /**
     * @var string
     */
    protected $stopDaemonCommand;

    /**
     * @var string
     */
    protected $startDaemonCommand;

    /**
     * Monit constructor.
     *
     * @param string $serviceName
     * @param string $config
     *
     * @throws \ReflectionException
     */
    public function __construct(string $serviceName)
    {
        $this->serviceName = $serviceName;
        $this->processName = $serviceName;
        $this->filePath = getenv('MONIT_FILES_PATH') ?? static::MONIT_FILES_PATH . "/$serviceName";
        $this->stopDaemonCommand =
            getenv('DAEMON_STARTER_PATH') ?? static::DAEMON_STARTER_PATH
            . ' '
            . Daemon::OPERATION_STOP
            . " $serviceName";
        $this->stopDaemonCommand =
            getenv('DAEMON_STARTER_PATH') ?? static::DAEMON_STARTER_PATH
            . ' '
            . Daemon::OPERATION_START
            . " $serviceName";
    }

    /**
     * @return string
     */
    public function getServiceName() : string
    {
        return $this->serviceName;
    }

    /**
     * @param string $serviceName
     */
    public function setServiceName(string $serviceName) : void
    {
        $this->serviceName = $serviceName;
    }

    /**
     * @return string
     */
    public function getProcessName() : string
    {
        return $this->processName;
    }

    /**
     * @param string $processName
     */
    public function setProcessName(string $processName) : void
    {
        $this->processName = $processName;
    }

    /**
     * @return string
     */
    public function getFilePath() : string
    {
        return $this->filePath;
    }

    /**
     * @param string $filePath
     */
    public function setFilePath(string $filePath) : void
    {
        $this->filePath = $filePath;
    }

    /**
     * @return string
     */
    public function getStopDaemonCommand() : string
    {
        return $this->stopDaemonCommand;
    }

    /**
     * @param string $stopDaemonCommand
     */
    public function setStopDaemonCommand(string $stopDaemonCommand) : void
    {
        $this->stopDaemonCommand = $stopDaemonCommand;
    }

    /**
     * @return string
     */
    public function getStartDaemonCommand() : string
    {
        return $this->startDaemonCommand;
    }

    /**
     * @param string $startDaemonCommand
     */
    public function setStartDaemonCommand(string $startDaemonCommand) : void
    {
        $this->startDaemonCommand = $startDaemonCommand;
    }

    /**
     * @return string
     */
    protected function renderContent() : string
    {
        return
            "check process {$this->processName}\n" .
            "matching \"{$this->processName}\"\n" .
            "start program = \"{$this->startDaemonCommand}\"\n" .
            "stop program = \"{$this->stopDaemonCommand}\"";
    }

    /**
     * @throws FileNotAvailableException
     */
    public function saveFile() : void
    {
        if (file_put_contents($this->filePath, $this->renderContent())) {
            throw new FileNotAvailableException();
        }
    }

    /**
     * @throws FileNotAvailableException
     */
    public function removeFile() : void
    {
        if (unlink($this->filePath)) {
            throw new FileNotAvailableException();
        }
    }
}