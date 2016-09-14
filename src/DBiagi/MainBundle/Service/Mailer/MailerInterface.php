<?php

namespace DBiagi\MainBundle\Service\Mailer;

/**
 * Description of MailerInterface
 *
 * @author diego
 */
class MailerInterface {
    /**
     * Send the message
     * @return bool
     */
    public function send();
    
    /**
     * Set from.
     * @return $this
     */
    public function setFrom($from);
    
    /**
     * Set from name.
     * @return $this
     */
    public function setFromName($name);
    
    /**
     * Set the destiny mail address.
     * @return $this
     */
    public function setTo($email);
    
    /**
     * Set the mail content.
     * @return $this
     */
    public function setBody($body);
    
    /**
     * Add attachment
     * @return $this
     */
    public function addAttachment();
}
