<?php

namespace DBiagi\MainBundle\EventSubscriber;

use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\FOSUserEvents;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;

/**
 * Event listener to set a default user name on registration.
 *
 * @author diego
 */
class UserRegistrationSubscriber implements EventSubscriberInterface {


    public static function getSubscribedEvents() {
        return [
            FOSUserEvents::REGISTRATION_INITIALIZE => 'onUserRegistrationInitialize',
        ];
    }

    /**
     * @param UserEvent $event
     */
    public function onUserRegistrationInitialize(UserEvent $event) {
        $values = $event->getRequest()->get('fos_user_registration_form');
        $event->getUser()->setUsername($values['email']);
    }

}
