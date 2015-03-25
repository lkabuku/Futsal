<?php

namespace Futsal\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * GameTeam
 *
 * @ORM\Table(name="fut_game_team")
 * @ORM\Entity(repositoryClass="Futsal\TournamentBundle\Entity\GameTeamRepository")
 */
class GameTeam
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
     * @ORM\Column(name="goals", type="smallint")
     */
    private $goals;

    /**
     * @ORM\ManyToOne(targetEntity="Futsal\TournamentBundle\Entity\Game")
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
    */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity="Futsal\TournamentBundle\Entity\Team")
     * @ORM\JoinColumn(name="team_id", referencedColumnName="id")
    */
    private $team;
    
    
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
     * Set goal
     *
     * @param integer $goal
     * @return GameTeam
     */
    public function setGoal($goal)
    {
        $this->goal = $goal;

        return $this;
    }

    /**
     * Get goal
     *
     * @return integer 
     */
    public function getGoal()
    {
        return $this->goal;
    }

    /**
     * Set goals
     *
     * @param integer $goals
     * @return GameTeam
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
     * @return GameTeam
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
     * @return GameTeam
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
}
