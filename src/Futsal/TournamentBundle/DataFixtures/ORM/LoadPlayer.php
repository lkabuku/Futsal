<?php

namespace Futsal\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Futsal\TournamentBundle\Entity\Player;

class LoadPlayer extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Players list
        $names = array('RTC', 'K5', 'FamilyTeam', 'Masia', 'PSG', "FC Moody", "TeamMills", "Cergy");

        foreach ($names as $name) {
            
            
            for ($i=1;$i<=5;$i++) {
                // We create the player
                $player = new Player();
                $player->setFirstname($name."_player".$i);
                $player->setUsername($name."_player".$i);

                // We persist it
                $manager->persist($player);
            }
        }

        // Then we record all the players
        $manager->flush();
    }

    public function getOrder() {
        return 3;
    }

}