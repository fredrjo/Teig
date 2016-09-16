<?php

namespace Acme\GrabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Grabdata
 *
 * @ORM\Table(name="grabdata", indexes={@ORM\Index(name="grabdata_grab_sequence_id", columns={"grab_sequence_id"}), @ORM\Index(name="grabdata_meter_id", columns={"meter_id"})})
 * @ORM\Entity
 */
class Grabdata
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="metertime", type="datetime", nullable=false)
     */
    private $metertime;

    /**
     * @var string
     *
     * @ORM\Column(name="metervalue", type="decimal", precision=10, scale=5, nullable=false)
     */
    private $metervalue;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

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
     * @var \Acme\GrabBundle\Entity\Grabsequence
     *
     * @ORM\ManyToOne(targetEntity="Acme\GrabBundle\Entity\Grabsequence")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="grab_sequence_id", referencedColumnName="id")
     * })
     */
    private $grabSequence;



    /**
     * Set metertime
     *
     * @param \DateTime $metertime
     *
     * @return Grabdata
     */
    public function setMetertime($metertime)
    {
        $this->metertime = $metertime;

        return $this;
    }

    /**
     * Get metertime
     *
     * @return \DateTime
     */
    public function getMetertime()
    {
        return $this->metertime;
    }

    /**
     * Set metervalue
     *
     * @param string $metervalue
     *
     * @return Grabdata
     */
    public function setMetervalue($metervalue)
    {
        $this->metervalue = $metervalue;

        return $this;
    }

    /**
     * Get metervalue
     *
     * @return string
     */
    public function getMetervalue()
    {
        return $this->metervalue;
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
     * Set meter
     *
     * @param \Acme\GrabBundle\Entity\Meter $meter
     *
     * @return Grabdata
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
     * Set grabSequence
     *
     * @param \Acme\GrabBundle\Entity\Grabsequence $grabSequence
     *
     * @return Grabdata
     */
    public function setGrabSequence(\Acme\GrabBundle\Entity\Grabsequence $grabSequence = null)
    {
        $this->grabSequence = $grabSequence;

        return $this;
    }

    /**
     * Get grabSequence
     *
     * @return \Acme\GrabBundle\Entity\Grabsequence
     */
    public function getGrabSequence()
    {
        return $this->grabSequence;
    }
}
