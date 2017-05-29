<?php

namespace Iris\Command;

use Iris\Iris;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class VersionCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('iris:version')
            ->setDescription('Get information about installed Iris CRM version')
            ->setHelp("This command allows you to get information about installed Iris CRM version")
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln([
            '',
            '==========',
            ' Iris CRM ',
            '==========',
            '',
        ]);

        $rootDir = Iris::$app->getRootDir();

        $coreXml = simplexml_load_file(Iris::$app->getCoreDir() . 'core/version.xml');
        $output->writeln('Core: ' . $coreXml->CURRENT_VERSION);

        $loader = Iris::$app->getContainer()->get('loader');
        foreach (array_reverse($loader->getHierarchy()) as $item) {
            if (is_file($rootDir . $item['directory'] . 'version.xml')) {
                $configXml = simplexml_load_file($rootDir . $item['directory'] . 'version.xml');
                $output->writeln('Config ' . $configXml->CONFIGURATION_NAME . ': ' . $configXml->CURRENT_VERSION);
            }
        }

        $output->writeln('');
    }
}