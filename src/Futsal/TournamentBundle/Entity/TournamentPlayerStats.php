<?php

namespace Futsal\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * TournamentPlayerStats
 *
 * @ORM\Table(name="fut_tournament_player_stats", uniqueConstraints={@ORM\UniqueConstraint(name="constraint_tps", columns={"tournament_id", "game_id", "player_id"})} )
 * @ORM\Entity(repositoryClass="Futsal\TournamentBundle\Entity\TournamentPlayerStatsRepository")
 */
class TournamentPlayerStats
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
     * @ORM\Column(name="nb_goals", type="smallint")
     */
    private $nbGoals;

    /**
     * @var integer
     *
     * @ORM\Column(name="has_subscribed", type="smallint")
     */
    private $hasSubscribed;
    
    /**
     * @ORM\ManyToOne(targetEntity="Futsal\TournamentBundle\Entity\Game", inversedBy="game", cascade={"remove"})
     * @ORM\JoinColumn(name="game_id", referencedColumnName="id")
    */
    private $game;

    /**
     * @ORM\ManyToOne(targetEntity="Futsal\TournamentBundle\Entity\Tournament", inversedBy="tournament", cascade={"remove"})
     * @ORM\JoinColumn(name="tournament_id", referencedColumnName="id")
    */
    private $tournament;
    
    /**
     * @ORM\ManyToOne(targetEntity="Futsal\TournamentBundle\Entity\Player", inversedBy="player", cascade={"remove"})
     * @ORM\JoinColumn(name="player_id", referencedColumnName="id")
    */
    private $player;
    
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
     * Set nbGoals
     *
     * @param integer $nbGoals
     * @return TournamentPlayerStats
     */
    public function setNbGoals($nbGoals)
    {
        $this->nbGoals = $nbGoals;

        return $this;
    }

    /**
     * Get nbGoals
     *
     * @return integer 
     */
    public function getNbGoals()
    {
        return $this->nbGoals;
    }

    /**
     * Set hasSubscribed
     *
     * @param integer $hasSubscribed
     * @return TournamentPlayerStats
     */
    public function setHasSubscribed($hasSubscribed)
    {
        $this->hasSubscribed = $hasSubscribed;

        return $this;
    }

    /**
     * Get hasSubscribed
     *
     * @return integer 
     */
    public function getHasSubscribed()
    {
        return $this->hasSubscribed;
    }

    /**
     * Set tournament
     *
     * @param string $tournament
     * @return TournamentPlayerStats
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

    /**
     * Set player
     *
     * @param string $player
     * @return TournamentPlayerStats
     */
    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * Get player
     *
     * @return string 
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * Set game
     *
     * @param string $game
     * @return TournamentPlayerStats
     */
    public function setGame($game)
    {
        $this->game = $game;

        return $this;
    }

    /**
     * Get game
     *
     * @return string 
     */
    public function getGame()
    {
        return $this->game;
    }
}
