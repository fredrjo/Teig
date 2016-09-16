<?php

namespace Acme\GrabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Historicalgrabqueue
 *
 * @ORM\Table(name="historicalgrabqueue", indexes={@ORM\Index(name="historicalgrabqueue_meter_id", columns={"meter_id"})})
 * @ORM\Entity
 */
class Historicalgrabqueue
{
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="from_date", type="datetime", nullable=false)
     */
    private $fromDate;

    /**
     * @var boolean
     *
     * @ORM\Column(name="done", type="boolean", nullable=false)
     */
    private $done;

    /**
     * @var string
     *
     * @ORM\Column(name="note", type="text", nullable=false)
     */
    private $note;

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
     * Set fromDate
     *
     * @param \DateTime $fromDate
     *
     * @return Historicalgrabqueue
     */
    public function setFromDate($fromDate)
    {
        $this->fromDate = $fromDate;

        return $this;
    }

    /**
     * Get fromDate
     *
     * @return \DateTime
     */
    public function getFromDate()
    {
        return $this->fromDate;
    }

    /**
     * Set done
     *
     * @param boolean $done
     *
     * @return Historicalgrabqueue
     */
    public function setDone($done)
    {
        $this->done = $done;

        return $this;
    }

    /**
     * Get done
     *
     * @return boolean
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set note
     *
     * @param string $note
     *
     * @return Historicalgrabqueue
     */
    public function setNote($note)
    {
        $this->note = $note;

        return $this;
    }

    /**
     * Get note
     *
     * @return string
     */
    public function getNote()
    {
        return $this->note;
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
     * @return Historicalgrabqueue
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
}
