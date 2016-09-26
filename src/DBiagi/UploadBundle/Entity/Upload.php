<?php

namespace DBiagi\UploadBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Vich\UploaderBundle\Mapping\Annotation as Vich;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

/**
 * File
 *
 * @ORM\Table(name="upload")
 * @ORM\Entity(repositoryClass="DBiagi\UploadBundle\Repository\UploadRepository")
 * @ORM\HasLifecycleCallbacks()
 * @Vich\Uploadable 
 */
class Upload
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="createdAt", type="datetime")
     */
    private $createdAt;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="updatedAt", type="datetime")
     */
    private $updatedAt;

    /**
     * @Vich\UploadableField(mapping="upload_file", fileNameProperty="path")
     * @var File|UploadFile
     */
    private $file;
    
    /**
     * File real path.
     * @ORM\Column(type="string", length=255, nullable=true)
     * @var string 
     */
    private $path;
    
    /**
     * File size in bytes.
     * @ORM\Column(name="size", type="integer")
     * @var int
     */
    private $size;
    
    /**
     * File extension.
     * @ORM\Column(name="extension", type="string", length=10, nullable=true)
     * @var string
     */
    private $extension;
    
    /**
     * File mimetype.
     * @ORM\Column(name="mime", type="string", length=40, nullable=true)
     * @var string
     */
    private $mime;
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return File
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return File
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return File
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updatedAt;
    }
    
    /**
     * Get media file
     * @return UploadedFile|File
     */
    public function getFile(){
        return $this->file;
    }
    
    /**
     * Set file.
     * @param string $file
     * @return \DBiagi\FileBundle\Entity\File
     */
    public function setFile(File $file){
        $this->file = $file;
        
        if($file instanceof UploadedFile){
            $this->updatedAt = new \DateTime();
        }
        
        return $this;
    }
    
    /**
     * 
     * @return string
     */
    public function getPath(){
        return $this->path;
    }
    
    /**
     * 
     * @param string $path
     * @return \DBiagi\FileBundle\Entity\File
     */
    public function setPath($path){
        $this->path = $path;
        
        return $this;
    }
    
    /**
     * @Assert\Callback()
     */
    public function validate(ExecutionContextInterface $context, $payload){
        $ext = $this->getFile()->getExtension();
        
        if(!in_array($ext, [
            'pdf', 'png', 'jpeg', 'jpg', 'gif'
        ])){
            $context->buildViolation('media.file.invalid_extension')
                ->atPath('file')
                ->addViolation();
        }
    }
    
    /**
     * Get file mime type.
     * @return string
     */
    public function getMime(){
        return $this->mime;
    }
    
    /**
     * Set mime type.
     * @param string $mime
     * @return \DBiagi\UploadBundle\Entity\Upload
     */
    public function setMime($mime){
        $this->mime = $mime;
        
        return $this;
    }
    
    /**
     * Get size.
     * @return int
     */
    public function getSize(){
        return $this->size;
    }
    
    /**
     * Set size.
     * @param int $size
     * @return \DBiagi\UploadBundle\Entity\Upload
     */
    public function setSize($size){
        $this->size = $size;
        
        return $this;
    }
    
    /**
     * Get extension.
     * @return string
     */
    public function getExtension(){
        return $this->extension;
    }
    
    /**
     * Set extension.
     * @param string $extension
     * @return \DBiagi\UploadBundle\Entity\Upload
     */
    public function setExtension($extension){
        $this->extension = $extension;
        
        return $this;
    }
    
    /** @ORM\PrePersist */
    public function onPrePersist(){
        $this->createdAt = new \DateTime();
        $this->updatedAt = new \DateTime();
    }
    
    /** @ORM\PreUpdate */
    public function onPreUpdate(){
        $this->updatedAt = new \DateTime();
    }
    
}

