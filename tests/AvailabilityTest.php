<?php

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Description of StatusCodeTest
 *
 * @author Diego de Biagi<diego.biagi@twodigital.com.br>
 */
class AvailabilityTest extends WebTestCase {

    private function getUris() {
        return [
            '/',
            '/galeria',
            '/contato',
            '/login',
            '/register',
            '/projeto',
        ];
        
        
    }

    public function testPageSucceful() {
        $client = self::createClient();
        $client->followRedirects(true);
        
        foreach ($this->getUris() as $uri) {
            $client->request('GET', $uri);            
            $this->assertTrue($client->getResponse()->isSuccessful(), sprintf('Uri %s loaded with status code: %s.'));            
        }
        
    }

}
