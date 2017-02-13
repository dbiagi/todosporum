<?php

namespace DBiagi\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AnimationPart
 *
 * @ORM\Table(name="animation_part")
 * @ORM\Entity(repositoryClass="DBiagi\MainBundle\Repository\AnimationPartRepository")
 */
class AnimationPart extends DatableEntity {
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var User
     *
     * @ORM\ManyToOne(targetEntity="DBiagi\MainBundle\Entity\User")
     */
    private $author;

    /**
     * @var string
     *
     * @ORM\Column(name="content", type="text")
     */
    private $content;

    /**
     * @var Animation
     *
     * @ORM\ManyToOne(targetEntity="DBiagi\MainBundle\Entity\Animation", inversedBy="parts")
     */
    private $animation;

    /**
     * @var string
     *
     * @ORM\Column(name="thumbnail", type="text")
     */
    private $thumbnail;

    /**
     * Get id
     *
     * @return int
     */
    public function getId() {
        return $this->id;
    }

    /**
     * Get content
     *
     * @return string
     */
    public function getContent() {
        return $this->content;
    }

    /**
     * Set content
     *
     * @param string $content
     *
     * @return AnimationPart
     */
    public function setContent($content) {
        $this->content = $content;

        return $this;
    }

    /**
     * @return User
     */
    public function getAuthor() {
        return $this->author;
    }

    /**
     * @param User $author
     * @return AnimationPart
     */
    public function setAuthor(User $author) {
        $this->author = $author;

        return $this;
    }

    /**
     * @return Animation
     */
    public function getAnimation() {
        return $this->animation;
    }

    /**
     * @param Animation $animation
     * @return AnimationPart
     */
    public function setAnimation($animation) {
        $this->animation = $animation;

        return $this;
    }

    /**
     * @return string
     */
    public function getThumbnail() {
        return $this->thumbnail;
    }

    /**
     * @param string $thumbnail
     * @return AnimationPart
     */
    public function setThumbnail($thumbnail) {
        $this->thumbnail = $thumbnail;

        return $this;
    }


}

