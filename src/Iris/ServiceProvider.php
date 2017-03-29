<?php

namespace Iris;

use DB;
use Iris\Model\Service\LoggerFactory;

class ServiceProvider
{
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerBuilder
     */
    protected $container;

    public function __construct()
    {
        $this->container = Iris::$app->getContainer();
    }

    public function register()
    {
        /**
         * Logger
         */
        $this->container
            ->register('LoggerFactory', LoggerFactory::class)
            ->addArgument(Iris::$app->getLogDir())
            ->addArgument(Iris::$app->config('sentry.dsn'));

        /**
         * DB
         */
        $this->container
            ->register('DB', DB::class)
            ->setFactory([DB::class, 'getInstance']);
    }
}