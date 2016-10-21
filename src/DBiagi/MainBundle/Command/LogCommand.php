<?php

namespace DBiagi\MainBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class LogCommand extends ContainerAwareCommand {

    protected function configure() {
        $this
            ->setName('main:log')
            ->setDescription('Add log.')
            ->addArgument('type', InputArgument::REQUIRED, 'Log type.')
            ->addArgument('message', InputArgument::REQUIRED, 'Log message.')

        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output) {
        $type = $input->getArgument('type');
        $msg  = $input->getArgument('message');
        
        try {
            $this->getContainer()->get('monolog.logger.user')->log($type, $msg);
            $outputMessage = 'Log created';
        } catch (\Exception $exc) {
            $outputMessage = 'Error. Message: ' . $exc->getMessage();
        }

        $output->writeln($outputMessage);
    }

}
