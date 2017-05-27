<?php

namespace Iris\Command;

use Iris\Iris;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GenerateGulpConfigCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('iris:generate-gulp-config')
            ->setDescription('Generate configuration file for Gulp')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $directories = [];
        foreach (Iris::$app->getContainer()->get('loader')->getHierarchy() as $item) {
            $directories[] = $item['directory'];
        }

        $data = "module.exports = { 
    configDirectories: ['" . Iris::$app->getRootDir() . implode("', '", $directories) . "'],
    coreDirectory: '" . Iris::$app->getCoreDir() . "'
};
";

        file_put_contents(Iris::$app->getBuildDir() . 'gulp-config.js', $data);
    }
}