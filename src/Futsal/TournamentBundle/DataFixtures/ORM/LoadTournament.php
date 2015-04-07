<?php

namespace Futsal\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Futsal\TournamentBundle\Entity\Tournament;

class LoadTournament extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Tournament list to add
        $tournamentList = array(
                    0 => array("lundi20_0315", "Championnat du Lundi à 20h - Session Mars 2015"),
                    1 => array("lundi21_0315", "Championnat du Lundi à 21h - Session Mars 2015"),
                );
        
        foreach($tournamentList as $item) {
            
            // We create the tournament
            $tournament = new Tournament();
            $tournament->setName($item[0]);
            $tournament->setLabelname($item[1]);
            
            // We persist it
            $manager->persist($tournament);
        }

        // Then we record all the tournament
        $manager->flush();
    }

    public function getOrder() {
        return 3;
    }

}