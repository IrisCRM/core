<?php

namespace Iris\Command;

use Iris\Iris;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;


class RemindUpdateCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('iris:remind:update')
            ->setDescription('Update reminds and send notifications for all Iris CRM users')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $loader = Iris::$app->getContainer()->get('loader');

        require_once $loader->corePath() .'core/engine/remind.php';

        $result = RefreshCurrentRemindings(0);

        $output->writeln("=== update reminds ===");
        $output->writeln("errflag: " . ($result["errflag"] ?? "null"));
        $output->writeln("frequently: " . ($result["frequently"] ?? "null"));
        $output->writeln("message: " . $result["message"]);
        $output->writeln("======================");
    }
}
