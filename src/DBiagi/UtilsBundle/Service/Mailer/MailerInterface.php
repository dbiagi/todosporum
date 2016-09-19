<?php

namespace DBiagi\UtilsBundle\Service\Mailer;

/**
 * Description of MailerInterface
 *
 * @author diego
 */
interface MailerInterface {
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
     * @param array $files Array of file absolute file paths to attach.
     */
    public function addAttachments(array $files);
}
