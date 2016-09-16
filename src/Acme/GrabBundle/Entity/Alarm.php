<?php

namespace Acme\GrabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Alarm
 *
 * @ORM\Table(name="alarm", indexes={@ORM\Index(name="alarm_export_schedule_id", columns={"export_schedule_id"})})
 * @ORM\Entity
 */
class Alarm
{
    /**
     * @var string
     *
     * @ORM\Column(name="subject", type="string", length=255, nullable=false)
     */
    private $subject;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text", nullable=false)
     */
    private $message;

    /**
     * @var boolean
     *
     * @ORM\Column(name="sent", type="boolean", nullable=false)
     */
    private $sent;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="sent_time", type="datetime", nullable=false)
     */
    private $sentTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Acme\GrabBundle\Entity\Exportschedule
     *
     * @ORM\ManyToOne(targetEntity="Acme\GrabBundle\Entity\Exportschedule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="export_schedule_id", referencedColumnName="id")
     * })
     */
    private $exportSchedule;



    /**
     * Set subject
     *
     * @param string $subject
     *
     * @return Alarm
     */
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    /**
     * Get subject
     *
     * @return string
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return Alarm
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set sent
     *
     * @param boolean $sent
     *
     * @return Alarm
     */
    public function setSent($sent)
    {
        $this->sent = $sent;

        return $this;
    }

    /**
     * Get sent
     *
     * @return boolean
     */
    public function getSent()
    {
        return $this->sent;
    }

    /**
     * Set sentTime
     *
     * @param \DateTime $sentTime
     *
     * @return Alarm
     */
    public function setSentTime($sentTime)
    {
        $this->sentTime = $sentTime;

        return $this;
    }

    /**
     * Get sentTime
     *
     * @return \DateTime
     */
    public function getSentTime()
    {
        return $this->sentTime;
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
     * Set exportSchedule
     *
     * @param \Acme\GrabBundle\Entity\Exportschedule $exportSchedule
     *
     * @return Alarm
     */
    public function setExportSchedule(\Acme\GrabBundle\Entity\Exportschedule $exportSchedule = null)
    {
        $this->exportSchedule = $exportSchedule;

        return $this;
    }

    /**
     * Get exportSchedule
     *
     * @return \Acme\GrabBundle\Entity\Exportschedule
     */
    public function getExportSchedule()
    {
        return $this->exportSchedule;
    }
}
