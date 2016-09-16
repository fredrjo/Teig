<?php

namespace Acme\GrabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Exportschedule
 *
 * @ORM\Table(name="exportschedule", indexes={@ORM\Index(name="exportschedule_grabber_id", columns={"grabber_id"}), @ORM\Index(name="exportschedule_importmail_id", columns={"importmail_id"})})
 * @ORM\Entity
 */
class Exportschedule
{
    /**
     * @var integer
     *
     * @ORM\Column(name="weekday", type="integer", nullable=false)
     */
    private $weekday;

    /**
     * @var integer
     *
     * @ORM\Column(name="hour", type="integer", nullable=false)
     */
    private $hour;

    /**
     * @var boolean
     *
     * @ORM\Column(name="disabled", type="boolean", nullable=false)
     */
    private $disabled;

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
     * @var \Acme\GrabBundle\Entity\Importmail
     *
     * @ORM\ManyToOne(targetEntity="Acme\GrabBundle\Entity\Importmail")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="importmail_id", referencedColumnName="id")
     * })
     */
    private $importmail;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Acme\GrabBundle\Entity\Contact", mappedBy="exportschedule")
     */
    private $contact;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->contact = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set weekday
     *
     * @param integer $weekday
     *
     * @return Exportschedule
     */
    public function setWeekday($weekday)
    {
        $this->weekday = $weekday;

        return $this;
    }

    /**
     * Get weekday
     *
     * @return integer
     */
    public function getWeekday()
    {
        return $this->weekday;
    }

    /**
     * Set hour
     *
     * @param integer $hour
     *
     * @return Exportschedule
     */
    public function setHour($hour)
    {
        $this->hour = $hour;

        return $this;
    }

    /**
     * Get hour
     *
     * @return integer
     */
    public function getHour()
    {
        return $this->hour;
    }

    /**
     * Set disabled
     *
     * @param boolean $disabled
     *
     * @return Exportschedule
     */
    public function setDisabled($disabled)
    {
        $this->disabled = $disabled;

        return $this;
    }

    /**
     * Get disabled
     *
     * @return boolean
     */
    public function getDisabled()
    {
        return $this->disabled;
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
     * @return Exportschedule
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

    /**
     * Set importmail
     *
     * @param \Acme\GrabBundle\Entity\Importmail $importmail
     *
     * @return Exportschedule
     */
    public function setImportmail(\Acme\GrabBundle\Entity\Importmail $importmail = null)
    {
        $this->importmail = $importmail;

        return $this;
    }

    /**
     * Get importmail
     *
     * @return \Acme\GrabBundle\Entity\Importmail
     */
    public function getImportmail()
    {
        return $this->importmail;
    }

    /**
     * Add contact
     *
     * @param \Acme\GrabBundle\Entity\Contact $contact
     *
     * @return Exportschedule
     */
    public function addContact(\Acme\GrabBundle\Entity\Contact $contact)
    {
        $this->contact[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \Acme\GrabBundle\Entity\Contact $contact
     */
    public function removeContact(\Acme\GrabBundle\Entity\Contact $contact)
    {
        $this->contact->removeElement($contact);
    }

    /**
     * Get contact
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContact()
    {
        return $this->contact;
    }
    public function __toString() {
      return $this->grabber.' '.$this->weekday;
    }
}
