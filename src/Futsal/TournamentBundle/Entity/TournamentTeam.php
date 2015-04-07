<?php

namespace Futsal\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * TournamentTeam
 *
 * @ORM\Table(name="fut_tournament_team")
 * @ORM\Entity(repositoryClass="Futsal\TournamentBundle\Entity\TournamentTeamRepository")
 */
class TournamentTeam
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
     * @ORM\ManyToOne(targetEntity="Futsal\TournamentBundle\Entity\Team")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
    */
    private $team;

    /**
     * @ORM\ManyToOne(targetEntity="Futsal\TournamentBundle\Entity\Tournament")
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
    */
    private $tournament;


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
     * Set team
     *
     * @param string $team
     * @return TournamentTeam
     */
    public function setTeam($team)
    {
        $this->team = $team;

        return $this;
    }

    /**
     * Get team
     *
     * @return string 
     */
    public function getTeam()
    {
        return $this->team;
    }

    /**
     * Set tournament
     *
     * @param string $tournament
     * @return TournamentTeam
     */
    public function setTournament($tournament)
    {
        $this->tournament = $tournament;

        return $this;
    }

    /**
     * Get tournament
     *
     * @return string 
     */
    public function getTournament()
    {
        return $this->tournament;
    }
}
