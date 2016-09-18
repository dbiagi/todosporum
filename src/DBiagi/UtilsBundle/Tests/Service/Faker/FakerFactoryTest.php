<?php

namespace DBiagi\UtilsBundle\Tests\Service\Faker;

use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;

/**
 * Description of FakerFactory
 *
 * @author diego
 */
class FakerFactoryTest extends KernelTestCase {

    /** @var \Symfony\Component\DependencyInjection\ContainerInterface */
    private $faker = null;
    
    protected function setUp() {
        self::bootKernel();
        
        $this->faker = self::$kernel->getContainer()->get('faker');
    }
    
    public function testFakerCreation(){
        $this->assertTrue(true);
    }

}
