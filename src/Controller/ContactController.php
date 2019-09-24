<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Mime\Email;
use Symfony\Component\Mime\NamedAddress;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{

    /**
     * @Route("/contato", name="main_contato")
     *
     * @param Request $request
     * @param MailerInterface $mailer
     *
     * @return Response
     */
    public function contactAction(Request $request, MailerInterface $mailer)
    {
        if ('POST' !== $request->getMethod()) {
            return $this->render('Pages/contato.html.twig');
        }

        if (!$request->get('from') || !$request->get('name') || !$request->get('message')) {
            $request->getSession()->getFlashBag()->add('error', 'contact.missing_fields');
        }

        $message = (new Email())
            ->subject('[Todos Por Um] Mensagem do ' . $request->get('name'))
            ->from(new NamedAddress($request->get('name'), $request->get('from')))
            ->replyTo(new NamedAddress($request->get('name'), $request->get('from')))
            ->to(new Address($this->getParameter('admin_email')))
            ->setBody($request->get('message'));

        try {
            $mailer->send($message);
            $request->getSession()->getFlashBag()->add('success', 'contact.success');
        } catch (TransportExceptionInterface $e) {
            $request->getSession()->getFlashBag()->add('success', 'contact.error');
            $this->get('logger')->error('Erro ao enviar email.');
        }

        return $this->redirectToRoute('main_contato');

    }

}
