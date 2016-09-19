<?php

namespace DBiagi\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class IndexController extends Controller {

    /**
     * @Route("/contato", name="main_contato")
     * @param Request $request
     * @return Response
     */
    public function contactAction(Request $request) {
               
        if ('POST' === $request->getMethod()) {
            $message = \Swift_Message::newInstance()
                ->setSubject('[Todos Por Um] Mensagem do ' . $request->get('name'))
                ->setFrom($request->get('from'), $request->get('name'))
                ->setReplyTo($request->get('from'), $request->get('name'))
                ->setTo($this->getParameter('admin_email'))
                ->setBody($request->get('message'))
            ;
            
            $result = $this->get('mailer')->send($message);
            
            if($result){
                $request->getSession()->getFlashBag()->add('success', 'Enviamos sua mensagem, leremos assim que der. Obrigado.');
            } else {
                $request->getSession()->getFlashBag()->add('success', 'Ops, deu algo errado. Por favor, tente novamente mais tarde.');
                $this->get('logger')->error('Erro ao enviar email.');
            }
            
            return $this->redirectToRoute('main_contato');
        }
        
        return $this->render('Pages/contato.html.twig');
    }

}
