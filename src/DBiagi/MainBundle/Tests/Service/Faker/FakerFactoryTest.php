<?php

namespace DBiagi\MainBundle\Tests\Faker;

/**
 * Description of FakerFactoryTest
 *
 * @author Diego de Biagi<diegobiagiviana@gmail.com>
 */
class FakerFactoryTest extends \PHPUnit_Framework_TestCase{
    
    public function testCreateFaker() {
        $faker = \DBiagi\MainBundle\Service\Faker\FakerFactory::createFaker('pt_BR');
        
        $this->assertNotNull($faker);
        
        $this->assertInstanceOf(\Faker\Generator::class, $faker);
    }
}
