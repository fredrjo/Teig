<?php

namespace Acme\GrabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Logindata
 *
 * @ORM\Table(name="logindata", uniqueConstraints={@ORM\UniqueConstraint(name="logindata_grabber_id_username_password", columns={"grabber_id", "username", "password"})}, indexes={@ORM\Index(name="logindata_grabber_id", columns={"grabber_id"})})
 * @ORM\Entity
 */
class Logindata
{
    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, nullable=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255, nullable=true)
     */
    private $password;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Acme\GrabBundle\Entity\Grabber
     *
     * @ORM\ManyToOne(targetEntity="Acme\GrabBundle\Entity\Grabber")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="grabber_id", referencedColumnName="id")
     * })
     */
    private $grabber;



    /**
     * Set username
     *
     * @param string $username
     *
     * @return Logindata
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return Logindata
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set grabber
     *
     * @param \Acme\GrabBundle\Entity\Grabber $grabber
     *
     * @return Logindata
     */
    public function setGrabber(\Acme\GrabBundle\Entity\Grabber $grabber = null)
    {
        $this->grabber = $grabber;

        return $this;
    }

    /**
     * Get grabber
     *
     * @return \Acme\GrabBundle\Entity\Grabber
     */
    public function getGrabber()
    {
        return $this->grabber;
    }
    public function __toString() {
      return 'Username: '.$this->username.' Password: '.$this->password;
    }
}
