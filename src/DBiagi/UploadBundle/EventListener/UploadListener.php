<?php

namespace DBiagi\UploadBundle\EventListener;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Vich\UploaderBundle\Event\Events as VichEvents;
use Vich\UploaderBundle\Event\Event as EventArgs;

/**
 * Description of FileUploadListener
 *
 * @author diego
 */
class FileUploadListener implements EventSubscriberInterface{
    
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
        $media = $event->getObject();
        
    }

}
