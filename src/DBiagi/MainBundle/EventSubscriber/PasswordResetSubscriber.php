<?php

namespace DBiagi\MainBundle\EventSubscriber;

use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\Event\GetResponseNullableUserEvent;
use FOS\UserBundle\Event\GetResponseUserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Bundle\TwigBundle\TwigEngine;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;

class PasswordResetSubscriber implements EventSubscriberInterface {

    /**
     * @var TwigEngine
     */
    private $router;

    /**
     * @var int
     */
    private $resetExpirationTokenTtl;

    function __construct(Router $router, $resetExpirationTokenTtl) {
        $this->router                  = $router;
        $this->resetExpirationTokenTtl = $resetExpirationTokenTtl;
    }

    public static function getSubscribedEvents() {
        return [
            FOSUserEvents::RESETTING_SEND_EMAIL_INITIALIZE => 'onUserResetInitialize',
            FOSUserEvents::RESETTING_SEND_EMAIL_COMPLETED  => 'onUserResetCompleted',
            FOSUserEvents::RESETTING_RESET_SUCCESS         => 'onResetSuccess',
        ];
    }

    /**
     * Manipula a redefinição de senha.
     * @param GetResponseNullableUserEvent $event
     * @return RedirectResponse
     */
    public function onUserResetInitialize(GetResponseNullableUserEvent $event) {
        $user     = $event->getUser();
        $request  = $event->getRequest();
        $flashBag = $request->getSession()->getFlashBag();

        if (null === $event->getUser()) { // Caso não for encontrado usuário com o email informado
            $msg = sprintf('Não há usuário cadastrado com o email %s', $request->request->get('username'));
            $flashBag->add('error', $msg);
            $event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));
        } elseif ($user->isPasswordRequestNonExpired($this->resetExpirationTokenTtl)) { // Token ainda ativo
            $msg = sprintf('Já foi solicitado uma redefinição de senha nas últimas 24hrs');
            $flashBag->add('error', $msg);
            $event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));
        }
    }

    /**
     * @param GetResponseUserEvent $event
     */
    public function onUserResetCompleted(GetResponseUserEvent $event) {
        $msg = 'Foi enviado um email para o endereço informado com o link para redefinir a senha.';
        $event->getRequest()->getSession()->getFlashBag()->add('success', $msg);
        $event->setResponse(new RedirectResponse($this->router->generate('fos_user_security_login')));
    }

    /**
     * Redireciona para home em caso de sucesso.
     * @param FormEvent $event
     */
    public function onResetSuccess(FormEvent $event) {
        $event->setResponse(new RedirectResponse($this->router->generate('main_home')));
    }
}