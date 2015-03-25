<?php

namespace Futsal\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ClassifyTeam
 *
 * @ORM\Table(name="fut_classify_team_in_tournament")
 * @ORM\Entity(repositoryClass="Futsal\TournamentBundle\Entity\ClassifyTeamRepository")
 */
class ClassifyTeam
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
     * @var integer
     *
     * @ORM\Column(name="position_group", type="smallint")
     */
    private $positionGroup;

    /**
     * @ORM\ManyToOne(targetEntity="Futsal\TournamentBundle\Entity\Team", inversedBy="team", cascade={"remove"})
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
    */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="Futsal\TournamentBundle\Entity\Tournament", inversedBy="tournament", cascade={"remove"})
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
    */
    private $tournament;
    
    /**
     * @ORM\ManyToOne(targetEntity="Futsal\TournamentBundle\Entity\Groups", inversedBy="groups", cascade={"remove"})
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
    */
    private $groups;

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
     * Set positionGroup
     *
     * @param integer $positionGroup
     * @return ClassifyTeam
     */
    public function setPositionGroup($positionGroup)
    {
        $this->positionGroup = $positionGroup;

        return $this;
    }

    /**
     * Get positionGroup
     *
     * @return integer 
     */
    public function getPositionGroup()
    {
        return $this->positionGroup;
    }

    /**
     * Set team
     *
     * @param \Futsal\TournamentBundle\Entity\Team $team
     * @return ClassifyTeam
     */
    public function setTeam(\Futsal\TournamentBundle\Entity\Team $team = null)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return \Futsal\TournamentBundle\Entity\Team 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set tournament
     *
     * @param \Futsal\TournamentBundle\Entity\Tournament $tournament
     * @return ClassifyTeam
     */
    public function setTournament(\Futsal\TournamentBundle\Entity\Tournament $tournament = null)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return \Futsal\TournamentBundle\Entity\Tournament 
     */
    public function getTournament()
    {
        return $this->tournament;
    }

    /**
     * Set groups
     *
     * @param \Futsal\TournamentBundle\Entity\Groups $groups
     * @return ClassifyTeam
     */
    public function setGroups(\Futsal\TournamentBundle\Entity\Groups $groups = null)
    {
        $this->groups = $groups;

        return $this;
    }

    /**
     * Get groups
     *
     * @return \Futsal\TournamentBundle\Entity\Groups 
     */
    public function getGroups()
    {
        return $this->groups;
    }
}
