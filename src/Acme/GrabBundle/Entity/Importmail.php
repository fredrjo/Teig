<?php

namespace Acme\GrabBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Importmail
 *
 * @ORM\Table(name="importmail", uniqueConstraints={@ORM\UniqueConstraint(name="importmail_importmail", columns={"importmail"})})
 * @ORM\Entity
 */
class Importmail
{
    /**
     * @var string
     *
     * @ORM\Column(name="importmail", type="string", length=255, nullable=false)
     */
    private $importmail;

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;



    /**
     * Set importmail
     *
     * @param string $importmail
     *
     * @return Importmail
     */
    public function setImportmail($importmail)
    {
        $this->importmail = $importmail;

        return $this;
    }

    /**
     * Get importmail
     *
     * @return string
     */
    public function getImportmail()
    {
        return $this->importmail;
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
    public function __toString() {
      return $this->importmail;
    }
}
