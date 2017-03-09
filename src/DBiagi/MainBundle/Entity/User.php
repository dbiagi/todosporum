<?php

namespace DBiagi\MainBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as BaseUser;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 *
 * @ORM\Table(name="tcc_user")
 * @ORM\Entity
 */
class User extends BaseUser {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=100, nullable=false)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Seu primeiro nome tem que ter no mínimo {{ limit }} caracteres",
     *      maxMessage = "Seu nome deve conter no máximo {{ limit }} caracteres"
     * )
     * @var string
     */
    private $firstName;

    /**
     * @ORM\Column(type="string", length=150, nullable=true)
     * @Assert\NotBlank()
     * @Assert\Length(
     *      min = 3,
     *      max = 50,
     *      minMessage = "Seu primeiro nome tem que ter no mínimo {{ limit }} caracteres",
     *      maxMessage = "Seu nome deve conter no máximo {{ limit }} caracteres"
     * )
     * @var type string
     */
    private $lastName;

    /**
     * Get first name.
     *
     * @return string
     */
    public function getFirstName() {
        return $this->firstName;
    }

    /**
     * Set first name.
     *
     * @param string $name
     * @return \DBiagi\MainBundle\Entity\User
     */
    public function setFirstName($name) {
        $this->firstName = $name;

        return $this;
    }

    /**
     * Get last name.
     *
     * @return string
     */
    public function getLastName() {
        return $this->lastName;
    }

    /**
     * Set last name.
     *
     * @param string $name
     * @return \DBiagi\MainBundle\Entity\User
     */
    public function setLastName($name) {
        $this->lastName = $name;

        return $this;
    }

    public function getUsername() {
        return $this->getEmail();
    }

    public function __toString() {
        return sprintf('%s (%d)', $this->username, $this->id);
    }

}
