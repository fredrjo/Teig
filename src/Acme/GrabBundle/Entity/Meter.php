<?php

namespace Acme\GrabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Meter
 *
 * @ORM\Table(name="meter", uniqueConstraints={@ORM\UniqueConstraint(name="meter_import_id_log_in_data_id", columns={"import_id", "log_in_data_id"})}, indexes={@ORM\Index(name="meter_log_in_data_id", columns={"log_in_data_id"}), @ORM\Index(name="meter_exportSchedule_id", columns={"exportSchedule_id"}), @ORM\Index(name="meter_status_id", columns={"status_id"})})
 * @ORM\Entity
 */
class Meter
{
    /**
     * @var string
     *
     * @ORM\Column(name="import_id", type="string", length=255, nullable=false)
     */
    private $importId;

    /**
     * @var string
     *
     * @ORM\Column(name="meterIdentifier", type="string", length=255, nullable=true)
     */
    private $meteridentifier;

    /**
     * @var string
     *
     * @ORM\Column(name="extraIdentifiers", type="string", length=255, nullable=true)
     */
    private $extraidentifiers;

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
     * @var \Acme\GrabBundle\Entity\Status
     *
     * @ORM\ManyToOne(targetEntity="Acme\GrabBundle\Entity\Status")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="status_id", referencedColumnName="status_code")
     * })
     */
    private $status;

    /**
     * @var \Acme\GrabBundle\Entity\Exportschedule
     *
     * @ORM\ManyToOne(targetEntity="Acme\GrabBundle\Entity\Exportschedule")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="exportSchedule_id", referencedColumnName="id")
     * })
     */
    private $exportschedule;

    /**
     * @var \Acme\GrabBundle\Entity\Logindata
     *
     * @ORM\ManyToOne(targetEntity="Acme\GrabBundle\Entity\Logindata")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="log_in_data_id", referencedColumnName="id")
     * })
     */
    private $logInData;



    /**
     * Set importId
     *
     * @param string $importId
     *
     * @return Meter
     */
    public function setImportId($importId)
    {
        $this->importId = $importId;

        return $this;
    }

    /**
     * Get importId
     *
     * @return string
     */
    public function getImportId()
    {
        return $this->importId;
    }

    /**
     * Set meteridentifier
     *
     * @param string $meteridentifier
     *
     * @return Meter
     */
    public function setMeteridentifier($meteridentifier)
    {
        $this->meteridentifier = $meteridentifier;

        return $this;
    }

    /**
     * Get meteridentifier
     *
     * @return string
     */
    public function getMeteridentifier()
    {
        return $this->meteridentifier;
    }

    /**
     * Set extraidentifiers
     *
     * @param string $extraidentifiers
     *
     * @return Meter
     */
    public function setExtraidentifiers($extraidentifiers)
    {
        $this->extraidentifiers = $extraidentifiers;

        return $this;
    }

    /**
     * Get extraidentifiers
     *
     * @return string
     */
    public function getExtraidentifiers()
    {
        return $this->extraidentifiers;
    }

    /**
     * Set disabled
     *
     * @param boolean $disabled
     *
     * @return Meter
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
     * Set status
     *
     * @param \Acme\GrabBundle\Entity\Status $status
     *
     * @return Meter
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
     * Set exportschedule
     *
     * @param \Acme\GrabBundle\Entity\Exportschedule $exportschedule
     *
     * @return Meter
     */
    public function setExportschedule(\Acme\GrabBundle\Entity\Exportschedule $exportschedule = null)
    {
        $this->exportschedule = $exportschedule;

        return $this;
    }

    /**
     * Get exportschedule
     *
     * @return \Acme\GrabBundle\Entity\Exportschedule
     */
    public function getExportschedule()
    {
        return $this->exportschedule;
    }

    /**
     * Set logInData
     *
     * @param \Acme\GrabBundle\Entity\Logindata $logInData
     *
     * @return Meter
     */
    public function setLogInData(\Acme\GrabBundle\Entity\Logindata $logInData = null)
    {
        $this->logInData = $logInData;

        return $this;
    }

    /**
     * Get logInData
     *
     * @return \Acme\GrabBundle\Entity\Logindata
     */
    public function getLogInData()
    {
        return $this->logInData;
    }
    public function __toString() {
      return $this->importId;
    }
}
