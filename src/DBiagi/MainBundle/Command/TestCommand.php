<?php

namespace DBiagi\MainBundle\Command;

use Symfony\Component\Console\Command\Command as BaseCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Console\Input\InputArgument;

/**
 * Description of LogCommand
 *
 * @author diego
 */
class TestCommand extends BaseCommand implements ContainerAwareInterface {

    /**
     * @var ContainerInterface
     */
    private $container = null;

    protected function execute(InputInterface $input, OutputInterface $output) {
        $env = $this->container->get('kernel')->getEnvironment();
        $output->writeln('ENV: ' . $env);
    }

    public function setContainer(ContainerInterface $container = null) {
        $this->container = $container;
    }

    protected function configure() {
        $this
            ->setName('test')
            ->setDescription('Test.')
        ;
    }

}
