<?php

namespace Futsal\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tournament
 *
 * @ORM\Table(name="fut_tournament")
 * @ORM\Entity(repositoryClass="Futsal\TournamentBundle\Entity\TournamentRepository")
 */
class Tournament
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
     * @ORM\Column(name="name", type="string", length=32, nullable=false)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="labelname", type="string", length=255, nullable=true)
     */
    private $labelname;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="string", length=512, nullable=true)
     */
    private $description;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_begin", type="date", nullable=true)
     */
    private $dateBegin;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date_end", type="date", nullable=true)
     */
    private $dateEnd;

    /**
     * @ORM\ManyToMany(targetEntity="Futsal\TournamentBundle\Entity\Team")
     * @ORM\JoinTable(name="fut_tournament_team_assoc", joinColumns={@ORM\JoinColumn(name="tournament_id", referencedColumnName="id")}, inverseJoinColumns={@ORM\JoinColumn(name="team_id", referencedColumnName="id")})
     **/
    private $teamsSubscribed;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->teamsSubscribed = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     * @return Tournament
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
     * @return Tournament
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
     * Set description
     *
     * @param string $description
     * @return Tournament
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string 
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set dateBegin
     *
     * @param \DateTime $dateBegin
     * @return Tournament
     */
    public function setDateBegin($dateBegin)
    {
        $this->dateBegin = $dateBegin;

        return $this;
    }

    /**
     * Get dateBegin
     *
     * @return \DateTime 
     */
    public function getDateBegin()
    {
        return $this->dateBegin;
    }

    /**
     * Set dateEnd
     *
     * @param \DateTime $dateEnd
     * @return Tournament
     */
    public function setDateEnd($dateEnd)
    {
        $this->dateEnd = $dateEnd;

        return $this;
    }

    /**
     * Get dateEnd
     *
     * @return \DateTime 
     */
    public function getDateEnd()
    {
        return $this->dateEnd;
    }

    /**
     * Add teamsSubscribed
     *
     * @param \Futsal\TournamentBundle\Entity\Team $teamsSubscribed
     * @return Tournament
     */
    public function addTeamsSubscribed(\Futsal\TournamentBundle\Entity\Team $teamsSubscribed)
    {
        $this->teamsSubscribed[] = $teamsSubscribed;

        return $this;
    }

    /**
     * Remove teamsSubscribed
     *
     * @param \Futsal\TournamentBundle\Entity\Team $teamsSubscribed
     */
    public function removeTeamsSubscribed(\Futsal\TournamentBundle\Entity\Team $teamsSubscribed)
    {
        $this->teamsSubscribed->removeElement($teamsSubscribed);
    }

    /**
     * Get teamsSubscribed
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTeamsSubscribed()
    {
        return $this->teamsSubscribed;
    }
}
