<?php

namespace Iris;

use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Class Application
 *
 * В классе приложения хранятся объекты, общие для всего проекта - DI контейнер, общие параметры
 *
 * @package Iris
 */
class Application
{

    /**
     * @var string Root directory of Iris CRM project
     */
    protected $rootDir;

    /**
     * @var string Directory for logs
     */
    protected $logDir;

    /**
     * @var string Directory for sources of project
     */
    protected $srcDir;

    /**
     * @var string Directory for build files
     */
    protected $buildDir;

    /**
     * @var string Directory for temporary files
     */
    protected $tempDir;

    /** @var string Current environment */
    protected $env;

    /**
     * @var ContainerBuilder
     */
    protected $container;

    /** @var  Configuration */
    protected $config;

    /**
     * Application constructor.
     * @param string $rootDir Root directory of Iris CRM project
     * @param string $logDir Directory for logs
     * @param string $srcDir Directory for sources of project
     * @param string $buildDir Directory for built files
     * @param string $tempDir Directory for temporary files
     * @param string $env Current environment
     * @throws IrisException
     */
    public function __construct($rootDir, $logDir, $srcDir, $buildDir, $tempDir, $env = '')
    {
        $this->rootDir = $rootDir;
        $this->logDir = $logDir;
        $this->srcDir = $srcDir;
        $this->buildDir = $buildDir;
        $this->tempDir = $tempDir;
        $this->env = $env;

        $this->container = new ContainerBuilder();

        $postfix = $this->getEnv() ? '-' . $this->getEnv() : '';
        $configurationFile = $this->rootDir . 'admin/settings/settings' . $postfix . '.xml';
        if (!file_exists($configurationFile) || !is_file($configurationFile) || !is_readable($configurationFile)) {
            throw new IrisException('Settings for specified environment were not found');
        }
        $xml = simplexml_load_file($configurationFile);
        $this->config = new Configuration($xml);
    }

    /**
     * Root directory of Iris CRM project
     * @return string
     */
    public function getRootDir()
    {
        return $this->rootDir;
    }

    /**
     * Directory for logs
     * @return string
     */
    public function getLogDir()
    {
        return $this->logDir;
    }

    /**
     * Directory for sources of project
     * @return string
     */
    public function getSrcDir()
    {
        return $this->srcDir;
    }

    /**
     * @return string
     */
    public function getBuildDir()
    {
        return $this->buildDir;
    }

    /**
     * @return string
     */
    public function getTempDir()
    {
        return $this->tempDir;
    }

    /**
     * @return string
     */
    public function getCoreDir()
    {
        return __DIR__ . DIRECTORY_SEPARATOR;
    }

    /**
     * @return string Current environment
     */
    public function getEnv()
    {
        return $this->env;
    }

    /**
     * @return ContainerBuilder
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * Get configuration parameter
     * @param string $key
     * @return mixed
     */
    public function config($key)
    {
        return $this->config->get($key);
    }

    /**
     * @return Configuration
     */
    public function getConfiguration()
    {
        return $this->config;
    }
}