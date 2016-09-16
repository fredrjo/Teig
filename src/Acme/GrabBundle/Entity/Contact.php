<?php

namespace Acme\GrabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Contact
 *
 * @ORM\Table(name="contact", uniqueConstraints={@ORM\UniqueConstraint(name="contact_name", columns={"name"}), @ORM\UniqueConstraint(name="contact_mail", columns={"mail"})})
 * @ORM\Entity
 */
class Contact
{
    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255, nullable=false)
     */
    private $mail;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var \Doctrine\Common\Collections\Collection
     *
     * @ORM\ManyToMany(targetEntity="Acme\GrabBundle\Entity\Exportschedule", inversedBy="contact")
     * @ORM\JoinTable(name="exportschedulecontact",
     *   joinColumns={
     *     @ORM\JoinColumn(name="contact_id", referencedColumnName="id")
     *   },
     *   inverseJoinColumns={
     *     @ORM\JoinColumn(name="exportschedule_id", referencedColumnName="id")
     *   }
     * )
     */
    private $exportschedule;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->exportschedule = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * Set name
     *
     * @param string $name
     *
     * @return Contact
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Contact
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
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
     * Add exportschedule
     *
     * @param \Acme\GrabBundle\Entity\Exportschedule $exportschedule
     *
     * @return Contact
     */
    public function addExportschedule(\Acme\GrabBundle\Entity\Exportschedule $exportschedule)
    {
        $this->exportschedule[] = $exportschedule;

        return $this;
    }

    /**
     * Remove exportschedule
     *
     * @param \Acme\GrabBundle\Entity\Exportschedule $exportschedule
     */
    public function removeExportschedule(\Acme\GrabBundle\Entity\Exportschedule $exportschedule)
    {
        $this->exportschedule->removeElement($exportschedule);
    }

    /**
     * Get exportschedule
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getExportschedule()
    {
        return $this->exportschedule;
    }
}
