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
        $names = array(
                1 => array('rtc', 'RTC', 'rtc', '21/08/2014'),
                2 => array('k5', 'K5', 'k5', '21/08/2014'),
                3 => array('familyteam', 'fat', 'rtc', '21/08/2014'),
                4 => array('masia', 'Masia', 'mas', '21/08/2014'),
                5 => array('psg', 'PSG', 'psg', '21/08/2014'),
                6 => array('fcmoody', 'fcm', 'rtc', '21/08/2014'),
                7 => array('teammills', 'tem', 'rtc', '21/08/2014'),
                8 => array('cergy', 'Cergy', 'cry', '21/08/2014'),
        );

        foreach ($names as $key => $name) {
            
            
            for ($i=1;$i<=5;$i++) {
                // We create the player
                $team = $manager->getRepository('FutsalTournamentBundle:Team')->find($key);
                
                $player = new Player();
                $player->setFirstname($name[0]."_fn".$i);
                $player->setLastname($name[0]."_ln".$i);
                $player->setUsername($name[0]."_un".$i);
                $player->setEmail($name[0]."_".$i."@email.fr");
                $player->setBirthday(\DateTime::createFromFormat('d/m/Y', "23/04/1985"));
                $player->setTeam($team);
                
                // We persist it
                $manager->persist($player);
            }
        }

        // Then we record all the players
        $manager->flush();
    }

    public function getOrder() {
        return 4;
    }

}