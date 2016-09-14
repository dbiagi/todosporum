<?php

namespace DBiagi\MainBundle\Tests\Service\Log\Handler;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of DatabaseHandlerTest
 *
 * @author Diego de Biagi<diegobiagiviana@gmail.com>
 */
class DatabaseHandlerTest extends KernelTestCase {

    private $container;

    public function setUp() {
        self::bootKernel();

        $this->container = self::$kernel->getContainer();
    }

    public function testMonologHandler() {
        $service = $this->container->get('monolog.handler.database');

        $this->assertNotNull($service);
    }

}
