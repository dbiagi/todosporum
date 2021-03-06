<?php

namespace DBiagi\MainBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Animation
 *
 * @ORM\Table(name="animation")
 * @ORM\Entity(repositoryClass="DBiagi\MainBundle\Repository\AnimationRepository")
 * @ORM\HasLifecycleCallbacks
 */
class Animation extends DatableEntity
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
     * @var User
     *
     * * @ORM\ManyToOne(targetEntity="User")
     */
    private $author;

    /**
     * @var AnimationPart[]
     *
     * @ORM\OneToMany(targetEntity="DBiagi\MainBundle\Entity\AnimationPart", mappedBy="animation")
     */
    private $parts;

    function __construct() {
        $this->parts = new ArrayCollection();
    }

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
}

