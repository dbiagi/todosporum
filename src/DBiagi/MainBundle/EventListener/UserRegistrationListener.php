<?php

namespace DBiagi\MainBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\UserEvent;

/**
 * Event listener to set a default user name on registration.
 *
 * @author diego
 */
class UserRegistrationListener implements EventSubscriberInterface{
    
    public static function getSubscribedEvents() {
        return [
            FOSUserEvents::REGISTRATION_INITIALIZE => 'onUserRegistrationInitialize'
        ];
    }
    
    public function onUserRegistrationInitialize(UserEvent $event){
        $user = $event->getUser();
        $values = $event->getRequest()->get('fos_user_registration_form');
        
        $username = sprintf('%s.%s',
            strtolower($values['firstname']), 
            strtolower($values['lastname'])
        );
        
        $user->setUsername($username);
    }

}
