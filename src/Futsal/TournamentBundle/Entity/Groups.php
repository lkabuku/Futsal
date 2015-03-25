<?php

namespace Futsal\TournamentBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Groups
 *
 * @ORM\Table(name="fut_group")
 * @ORM\Entity(repositoryClass="Futsal\TournamentBundle\Entity\GroupsRepository")
 */
class Groups
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
     * @ORM\Column(name="nb_qualified_teams", type="smallint")
     */
    private $nbQualifiedTeams;


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
     * Set nbQualifiedTeams
     *
     * @param integer $nbQualifiedTeams
     * @return Groups
     */
    public function setNbQualifiedTeams($nbQualifiedTeams)
    {
        $this->nbQualifiedTeams = $nbQualifiedTeams;

        return $this;
    }

    /**
     * Get nbQualifiedTeams
     *
     * @return integer 
     */
    public function getNbQualifiedTeams()
    {
        return $this->nbQualifiedTeams;
    }
}
