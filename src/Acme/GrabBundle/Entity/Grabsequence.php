<?php

namespace Acme\GrabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grabsequence
 *
 * @ORM\Table(name="grabsequence", indexes={@ORM\Index(name="grabsequence_grabber_id", columns={"grabber_id"}), @ORM\Index(name="grabsequence_meter_id", columns={"meter_id"}), @ORM\Index(name="grabsequence_status_id", columns={"status_id"})})
 * @ORM\Entity
 */
class Grabsequence
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="grabtime", type="datetime", nullable=false)
     */
    private $grabtime;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="period_from", type="datetime", nullable=false)
     */
    private $periodFrom;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="period_to", type="datetime", nullable=false)
     */
    private $periodTo;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Acme\GrabBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="Acme\GrabBundle\Entity\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_code")
     * })
     */
    private $status;

    /**
     * @var \Acme\GrabBundle\Entity\Meter
     *
     * @ORM\ManyToOne(targetEntity="Acme\GrabBundle\Entity\Meter")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="meter_id", referencedColumnName="id")
     * })
     */
    private $meter;

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
     * Set grabtime
     *
     * @param \DateTime $grabtime
     *
     * @return Grabsequence
     */
    public function setGrabtime($grabtime)
    {
        $this->grabtime = $grabtime;

        return $this;
    }

    /**
     * Get grabtime
     *
     * @return \DateTime
     */
    public function getGrabtime()
    {
        return $this->grabtime;
    }

    /**
     * Set periodFrom
     *
     * @param \DateTime $periodFrom
     *
     * @return Grabsequence
     */
    public function setPeriodFrom($periodFrom)
    {
        $this->periodFrom = $periodFrom;

        return $this;
    }

    /**
     * Get periodFrom
     *
     * @return \DateTime
     */
    public function getPeriodFrom()
    {
        return $this->periodFrom;
    }

    /**
     * Set periodTo
     *
     * @param \DateTime $periodTo
     *
     * @return Grabsequence
     */
    public function setPeriodTo($periodTo)
    {
        $this->periodTo = $periodTo;

        return $this;
    }

    /**
     * Get periodTo
     *
     * @return \DateTime
     */
    public function getPeriodTo()
    {
        return $this->periodTo;
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
     * Set status
     *
     * @param \Acme\GrabBundle\Entity\Status $status
     *
     * @return Grabsequence
     */
    public function setStatus(\Acme\GrabBundle\Entity\Status $status = null)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return \Acme\GrabBundle\Entity\Status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set meter
     *
     * @param \Acme\GrabBundle\Entity\Meter $meter
     *
     * @return Grabsequence
     */
    public function setMeter(\Acme\GrabBundle\Entity\Meter $meter = null)
    {
        $this->meter = $meter;

        return $this;
    }

    /**
     * Get meter
     *
     * @return \Acme\GrabBundle\Entity\Meter
     */
    public function getMeter()
    {
        return $this->meter;
    }

    /**
     * Set grabber
     *
     * @param \Acme\GrabBundle\Entity\Grabber $grabber
     *
     * @return Grabsequence
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
      return $this->grabber.' '.$this->meter;
    }
}
