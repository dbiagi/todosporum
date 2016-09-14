<?php

namespace DBiagi\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends Controller {

    public function sendAction(){
        $message = \Swift_Message::newInstance()
            ->setSubject('Olá Diego')
            ->setFrom($this->getParameter('admin_email'), $this->getParameter('admin_name'))
            ->setTo('diegobiagiviana@gmail.com')
            ->setBody('Teste de email pelo google' )
            ;
        
        $result = $this->get('mailer')->send($message) ? 'SUCESSO MLK' : 'DEU RUIM';

        
        return new Response($result, Response::HTTP_OK);
    }

}
