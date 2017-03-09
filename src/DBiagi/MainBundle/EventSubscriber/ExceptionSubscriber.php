<?php
/**
 * Created by PhpStorm.
 * User: diego
 * Date: 05/02/2017
 * Time: 22:53
 */

namespace DBiagi\MainBundle\EventSubscriber;

use Monolog\Logger;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Symfony\Component\HttpKernel\KernelEvents;

class ExceptionSubscriber implements EventSubscriberInterface {

    /** @var  Logger */
    private $logger;

    function __construct(Logger $logger) {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public static function getSubscribedEvents() {
        return [
            KernelEvents::EXCEPTION => 'onException',
        ];
    }

    public function onException(GetResponseForExceptionEvent $event) {
        if($event->getException() instanceof NotFoundHttpException){
            return;
        }

        $exc = $event->getException();
        $msg = sprintf('%s in %s line %d', $exc->getMessage(), $exc->getFile(), $exc->getLine());

        $this->logger->error($msg, [
            'exception' => $exc->getTraceAsString()
        ]);
    }
}