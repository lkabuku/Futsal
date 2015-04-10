<?php

namespace Futsal\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Result
 *
 * @ORM\Table(name="fut_result")
 * @ORM\Entity(repositoryClass="Futsal\TournamentBundle\Entity\ResultRepository")
 */
class Result
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
     * @ORM\Column(name="goals", type="smallint", nullable=true)
     */
    private $goals;
    
    /**
     * @var string
     *
     * @ORM\Column(name="result", type="string", nullable=true)
     */
    private $result;

    /**
     * @ORM\ManyToOne(targetEntity="Futsal\TournamentBundle\Entity\Game", inversedBy="gameResults")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
    */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity="Futsal\TournamentBundle\Entity\Team")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
    */
    private $team;
    
    /**
     * @ORM\ManyToOne(targetEntity="Futsal\TournamentBundle\Entity\Groups")
     * @ORM\JoinColumn(name="group_id", referencedColumnName="id")
    */
    private $group;
    
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
     * Set goals
     *
     * @param integer $goals
     * @return Result
     */
    public function setGoals($goals)
    {
        $this->goals = $goals;

        return $this;
    }

    /**
     * Get goals
     *
     * @return integer 
     */
    public function getGoals()
    {
        return $this->goals;
    }

    /**
     * Set game
     *
     * @param \Futsal\TournamentBundle\Entity\Game $game
     * @return Result
     */
    public function setGame(\Futsal\TournamentBundle\Entity\Game $game = null)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return \Futsal\TournamentBundle\Entity\Game 
     */
    public function getGame()
    {
        return $this->game;
    }

    /**
     * Set team
     *
     * @param \Futsal\TournamentBundle\Entity\Team $team
     * @return Result
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
     * Set group
     *
     * @param \Futsal\TournamentBundle\Entity\Groups $group
     * @return Result
     */
    public function setGroup(\Futsal\TournamentBundle\Entity\Groups $group = null)
    {
        $this->group = $group;

        return $this;
    }

    /**
     * Get group
     *
     * @return \Futsal\TournamentBundle\Entity\Groups 
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * Set tournament
     *
     * @param \Futsal\TournamentBundle\Entity\Tournament $tournament
     * @return Result
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
     * Set result
     *
     * @param string $result
     * @return Result
     */
    public function setResult($result)
    {
        $this->result = $result;

        return $this;
    }

    /**
     * Get result
     *
     * @return string 
     */
    public function getResult()
    {
        return $this->result;
    }
}
