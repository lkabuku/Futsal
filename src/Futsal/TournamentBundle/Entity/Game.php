<?php

namespace Futsal\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Game
 *
 * @ORM\Table(name="fut_game")
 * @ORM\Entity(repositoryClass="Futsal\TournamentBundle\Entity\GameRepository")
 */
class Game
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
     * @ORM\Column(name="referee", type="string", length=128, nullable=true)
     */
    private $referee;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetime", nullable=true)
     */
    private $date;
    
    /**
     * @var integer
     *
     * @ORM\Column(name="is_valid", type="smallint", nullable=true)
     */
    private $isValid;
    
    /**
     * @ORM\OneToMany(targetEntity="Futsal\TournamentBundle\Entity\GameTeam", mappedBy="game")
     **/
    private $gameResults;//Game results grouped by teams
    
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
     * Set referee
     *
     * @param string $referee
     * @return Game
     */
    public function setReferee($referee)
    {
        $this->referee = $referee;

        return $this;
    }

    /**
     * Get referee
     *
     * @return string 
     */
    public function getReferee()
    {
        return $this->referee;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     * @return Game
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime 
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set isValid
     *
     * @param integer $isValid
     * @return Game
     */
    public function setIsValid($isValid)
    {
        $this->isValid = $isValid;

        return $this;
    }

    /**
     * Get isValid
     *
     * @return integer 
     */
    public function getIsValid()
    {
        return $this->isValid;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->gameResults = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add gameResults
     *
     * @param \Futsal\TournamentBundle\Entity\GameTeam $gameResults
     * @return Game
     */
    public function addGameResult(\Futsal\TournamentBundle\Entity\GameTeam $gameResults)
    {
        $this->gameResults[] = $gameResults;

        return $this;
    }

    /**
     * Remove gameResults
     *
     * @param \Futsal\TournamentBundle\Entity\GameTeam $gameResults
     */
    public function removeGameResult(\Futsal\TournamentBundle\Entity\GameTeam $gameResults)
    {
        $this->gameResults->removeElement($gameResults);
    }

    /**
     * Get gameResults
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getGameResults()
    {
        return $this->gameResults;
    }
}
