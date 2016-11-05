<?php

namespace DBiagi\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Animation
 *
 * @ORM\Table(name="animation")
 * @ORM\Entity(repositoryClass="DBiagi\MainBundle\Repository\AnimationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Animation
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
     * @ORM\Column(name="title", type="string", length=255)
     */
    private $title;

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
     * @ORM\OneToOne(targetEntity="User")
     * @var User
     */
    private $author;
    

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
     * Set title
     *
     * @param string $title
     *
     * @return Animation
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Animation
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
     * @return Animation
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
     * Get author.
     * @return User
     */
    public function getAuthor(){
        return $this->author;
    }
    
    /**
     * Set author.
     * @param \DBiagi\MainBundle\Entity\User $author
     * @return \DBiagi\MainBundle\Entity\Animation
     */
    public function setAuthor(User $author){
        $this->author = $author;
        
        return $this;
    }
    
    /**
     * @ORM\PrePersist
     */
    public function onPrePersist(){
        $this->createdAt = new \DateTime();
        
        if($this->getUpdatedAt() === null){
            $this->setUpdatedAt(new \DateTime());
        }
    }
    
    /**
     * @ORM\PreUpdate
     */
    public function preUpdate(){
        $this->updatedAt = new \DateTime();
    }
}

