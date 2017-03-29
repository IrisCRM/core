<?php

namespace Iris\Model\Service;

use Monolog\Formatter\LineFormatter;
use Monolog\Handler\RavenHandler;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Raven_Client;
use Raven_ErrorHandler;

/**
 * Class Logger
 * @package Iris\Model\Service\Logger
 */
class LoggerFactory
{
    /**
     * @var Logger[]
     */
    protected $instances = [];

    /**
     * @var Raven_Client|null
     */
    protected $ravenClient = null;

    /**
     * @var string Sentry DSN
     */
    protected $sentryDsn;

    /**
     * @var string Directory for logs
     */
    protected $logDir;

    public function __construct($logDir, $sentryDsn)
    {
        $this->sentryDsn = $sentryDsn;
        $this->logDir = $logDir;
    }

    /**
     * Get needed logger instance
     * @param string $name File name for log
     * @param string $channel The logging channel
     * @param null|string|int $level
     * @return Logger
     */
    public function get($name = 'iriscrm', $channel = 'Default', $level = null)
    {
        if (!isset($this->instances[$name])) {
            $log = new Logger($channel);

            // Log into file
            $log->pushHandler(new StreamHandler($this->logDir . $name . '.log'));

            // Log into Sentry
            $client = $this->getRavenClient();
            if ($client) {
                // В Sentry логируем все, что имеет уровень не ниже Warning
                $handler = new RavenHandler($client, $level ? $level : Logger::WARNING);
                $handler->setFormatter(new LineFormatter("%message% %context% %extra%\n"));
                $log->pushHandler($handler);
            }

            $this->instances[$name] = $log;
        }
        return $this->instances[$name];
    }

    /**
     * @return Raven_Client|null
     */
    public function getRavenClient()
    {
        if (!$this->ravenClient) {
            if ($this->sentryDsn) {
                $this->ravenClient = new Raven_Client($this->sentryDsn);
            }
        }
        return $this->ravenClient;
    }

    /**
     * В Sentry логируем все ошибки и неотловленные исключения
     */
    public function registerHandlers()
    {
        if ($client = $this->getRavenClient()) {
            $errorHandler = new Raven_ErrorHandler($client);
            $errorHandler->registerExceptionHandler();
            $errorHandler->registerErrorHandler();
            $errorHandler->registerShutdownFunction();
        }
    }
}