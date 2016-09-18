<?php

namespace DBiagi\UtilsBundle\Service\Faker;

use Faker\Factory;

/**
 * Faker factory.
 *
 * @author Diego de Biagi<diegobiagiviana@gmail.com>
 */
class FakerFactory {
    
    /**
     * Get faker instance.
     * @param string $locale
     * @return Faker\Generator
     */
    public static function createFaker($locale) {
        $faker = Factory::create($locale);        
        
        foreach(self::getFakerProviders() as $provider){
            $faker->addProvider($provider);
        }
        
        return $faker;
    }
    
    private static function getFakerProviders(){
        return [
            
        ];
    }
    
}
