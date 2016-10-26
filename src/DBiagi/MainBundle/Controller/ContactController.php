<?php

namespace DBiagi\MainBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

class ContactController extends Controller {

    /**
     * @Route("/contato", name="main_contato")
     * @param Request $request
     * @return Response
     */
    public function contactAction(Request $request) {

        if ('POST' === $request->getMethod()) {

            if (!$request->get('from') || !$request->get('name') || !$request->get('message')) {
                $request->getSession()->getFlashBag()->add('error', 'contact.missing_fields');
            }

            $message = \Swift_Message::newInstance()
                ->setSubject('[Todos Por Um] Mensagem do ' . $request->get('name'))
                ->setFrom($request->get('from'), $request->get('name'))
                ->setReplyTo($request->get('from'), $request->get('name'))
                ->setTo($this->getParameter('admin_email'))
                ->setBody($request->get('message'))
            ;

            $result = $this->get('mailer')->send($message);

            if ($result) {
                $request->getSession()->getFlashBag()->add('success', 'contact.success');
            } else {
                $request->getSession()->getFlashBag()->add('success', 'contact.error');
                $this->get('logger')->error('Erro ao enviar email.');
            }

            return $this->redirectToRoute('main_contato');
        }

        return $this->render('Pages/contato.html.twig');
    }

}
