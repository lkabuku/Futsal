<?php

namespace Futsal\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Futsal\TournamentBundle\Entity\Team;

class LoadTeam extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // Teams list to add
        $names = array('RTC', 'K5', 'FamilyTeam', 'Masia', 'PSG', "FC Moody", "TeamMills", "Cergy");

        foreach ($names as $name) {
            // We create the team
            $team = new Team();
            $team->setName($name);

            // We persist it
            $manager->persist($team);
        }

        // Then we record all the teams
        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }

}