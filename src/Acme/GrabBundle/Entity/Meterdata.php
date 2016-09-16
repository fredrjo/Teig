<?php

namespace Acme\GrabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meterdata
 *
 * @ORM\Table(name="meterdata", indexes={@ORM\Index(name="meterdata_meter_id", columns={"meter_id"})})
 * @ORM\Entity
 */
class Meterdata
{
    /**
     * @var string
     *
     * @ORM\Column(name="metervalue", type="decimal", precision=16, scale=5, nullable=false)
     */
    private $metervalue;

    /**
     * @var boolean
     *
     * @ORM\Column(name="exported", type="boolean", nullable=false)
     */
    private $exported;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="metertime", type="datetime")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     */
    private $metertime;

    /**
     * @var \Acme\GrabBundle\Entity\Meter
     *
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="NONE")
     * @ORM\OneToOne(targetEntity="Acme\GrabBundle\Entity\Meter")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="meter_id", referencedColumnName="id")
     * })
     */
    private $meter;



    /**
     * Set metervalue
     *
     * @param string $metervalue
     *
     * @return Meterdata
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
     * Set exported
     *
     * @param boolean $exported
     *
     * @return Meterdata
     */
    public function setExported($exported)
    {
        $this->exported = $exported;

        return $this;
    }

    /**
     * Get exported
     *
     * @return boolean
     */
    public function getExported()
    {
        return $this->exported;
    }

    /**
     * Set metertime
     *
     * @param \DateTime $metertime
     *
     * @return Meterdata
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
     * Set meter
     *
     * @param \Acme\GrabBundle\Entity\Meter $meter
     *
     * @return Meterdata
     */
    public function setMeter(\Acme\GrabBundle\Entity\Meter $meter)
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
}
