<?php

namespace DBiagi\UploadBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Vich\UploaderBundle\Event\Events as VichEvents;
use Vich\UploaderBundle\Event\Event as EventArgs;
use DBiagi\UploadBundle\Entity\Upload;
use Doctrine\ORM\EntityManager;
use Symfony\Bridge\Monolog\Logger;

/**
 * Description of FileUploadListener
 *
 * @author diego
 */
class UploadListener implements EventSubscriberInterface {

    /** @var EntityManager */
    private $em;

    /** @var Logger */
    private $logger;

    public function __construct(EntityManager $em) {
        $this->em = $em;
    }

    public static function getSubscribedEvents() {
        return [
            VichEvents::PRE_UPLOAD => 'onPreUpload',
            //VichEvents::POST_REMOVE => 'onFileRemoved'
        ];
    }

    /**
     * Set media file metadata
     * @param EventArgs $event
     */
    public function onPreUpload(EventArgs $event) {
        /* @var $upload Upload */
        $upload = $event->getObject();

        $file = $upload->getFile();

        $upload->setName($file->getClientOriginalName());
        $upload->setMime($file->getMimeType());
        $upload->setSize($file->getSize());
        $upload->setExtension($file->getClientOriginalExtension());
    }

    public function onFileRemoved(EventArgs $event) {
        $this->em->remove($event->getObject());
        $this->em->flush();
    }

}
