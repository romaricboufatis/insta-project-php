<?php
/**
 * Created by PhpStorm.
 * User: Rodolphe
 * Date: 16/12/2014
 * Time: 15:10
 */

namespace Insta\PlanningBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class SwitchUserTypeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('user:csv:import')
            ->setDescription('Import a CSV user list')
            ->addArgument('filename', InputArgument::REQUIRED, 'The path to file ')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {



    }
}