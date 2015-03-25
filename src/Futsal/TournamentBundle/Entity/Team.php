<?php

namespace Futsal\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Team
 *
 * @ORM\Table(name="fut_team")
 * @ORM\Entity(repositoryClass="Futsal\TournamentBundle\Entity\TeamRepository")
 */
class Team
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=64)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="labelname", type="string", length=64)
     */
    private $labelname;

    /**
     * @var string
     *
     * @ORM\Column(name="logo", type="string", length=3)
     */
    private $logo;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_creation", type="date")
     */
    private $dateCreation;
    
    

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
     * Set name
     *
     * @param string $name
     * @return Team
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
     * Set labelname
     *
     * @param string $labelname
     * @return Team
     */
    public function setLabelname($labelname)
    {
        $this->labelname = $labelname;

        return $this;
    }

    /**
     * Get labelname
     *
     * @return string 
     */
    public function getLabelname()
    {
        return $this->labelname;
    }

    /**
     * Set logo
     *
     * @param string $logo
     * @return Team
     */
    public function setLogo($logo)
    {
        $this->logo = $logo;

        return $this;
    }

    /**
     * Get logo
     *
     * @return string 
     */
    public function getLogo()
    {
        return $this->logo;
    }

    /**
     * Set dateCreation
     *
     * @param \DateTime $dateCreation
     * @return Team
     */
    public function setDateCreation($dateCreation)
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    /**
     * Get dateCreation
     *
     * @return \DateTime 
     */
    public function getDateCreation()
    {
        return $this->dateCreation;
    }
}
