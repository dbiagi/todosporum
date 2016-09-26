<?php

namespace DBiagi\UploadBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Vich\UploaderBundle\Event\Events as VichEvents;
use Vich\UploaderBundle\Event\Event as EventArgs;
use DBiagi\UploadBundle\Entity\Upload;

/**
 * Description of FileUploadListener
 *
 * @author diego
 */
class UploadListener implements EventSubscriberInterface{
    
    public static function getSubscribedEvents() {
        return [
          VichEvents::PRE_UPLOAD => 'onPreUpload'  
        ];
    }
    
    /**
     * Set media file metadata
     * @param EventArgs $event
     */
    public function onPreUpload(EventArgs $event){
        /* @var $upload Upload */
        $upload = $event->getObject();
        
        $file = $upload->getFile();
        
        $upload->setName($file->getClientOriginalName());
        $upload->setMime($file->getMimeType());
        $upload->setSize($file->getSize());
        $upload->setExtension($file->getClientOriginalExtension());
    }

}
