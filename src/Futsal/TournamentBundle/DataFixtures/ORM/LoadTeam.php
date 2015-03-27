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
        $names = array(
                1 => array('rtc', 'RTC', 'rtc', '21/08/2014'),
                2 => array('k5', 'K5', 'k5x', '21/08/2014'),
                3 => array('familyteam', 'Family Team', 'fat', '21/08/2014'),
                4 => array('masia', 'Masia', 'mas', '21/08/2014'),
                5 => array('psg', 'PSG', 'psg', '21/08/2014'),
                6 => array('fcmoody', 'FC Moody', 'fcm', '21/08/2014'),
                7 => array('teammills', 'Team Mills', 'tem', '21/08/2014'),
                8 => array('cergy', 'Cergy', 'cry', '21/08/2014'),
        );
        
        foreach ($names as $name) {
            // We create the team
            $team = new Team();
            $team->setName($name[0]);
            $team->setLabelname($name[1]);
            $team->setLogo($name[2]);
            $team->setDateCreation(\DateTime::createFromFormat('d/m/Y', $name[3]));

            // We persist it
            $manager->persist($team);
        }

        // Then we record all the teams
        $manager->flush();
    }

    public function getOrder() {
        return 2;
    }

}