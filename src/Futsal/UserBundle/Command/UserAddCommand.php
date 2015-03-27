<?php

namespace Futsal\UserBundle\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UserAddCommand  extends Command
{
    protected function configure()
    {
        $this
            ->setName('user:add')
            ->setDescription('Add user in the back office')
            ->addArgument('user_values', InputArgument::IS_ARRAY, 'Tape "username", "password", "email" ')
            ->addOption('errors', null, InputOption::VALUE_NONE, 'Si définie, la tâche affichera les erreurs')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $userValues = $input->getArgument('user_values');
        
        $text = implode($userValues, ",");

        if ($input->getOption('errors')) {
            $text = strtoupper($text);
        }

        $output->writeln($text);
    }
}
