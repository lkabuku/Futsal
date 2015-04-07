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
        $a_teams = array(
                1 => array('rtc', 'RTC', 'rtc', '21/08/2014'),
                2 => array('k5', 'K5', 'k5x', '21/08/2014'),
                3 => array('familyteam', 'Family Team', 'fat', '21/08/2014'),
                4 => array('masia', 'Masia', 'mas', '21/08/2014'),
                5 => array('psg', 'PSG', 'psg', '21/08/2014'),
                6 => array('fcmoody', 'FC Moody', 'fmo', '21/08/2014'),
                7 => array('teammills', 'Team Mills', 'tem', '21/08/2014'),
                8 => array('cergy', 'Cergy', 'cry', '21/08/2014'),
                9 => array('leszoulous', 'Les Zoulous', 'lez', '21/08/2014'),
                10 => array('fcmagnum', 'FC Magnum', 'fma', '21/08/2014'),
                11 => array('smitch', 'Smitch', 'smi', '21/08/2014'),
                12 => array('dreamteam', 'Dream Team', 'drt', '21/08/2014'),
                13 => array('teamsamy', 'Team Samy', 'tes', '21/08/2014'),
                14 => array('teamgc', 'Team GC', 'tgc', '21/08/2014'),
                15 => array('tortuesninja', 'Tortues Ninja', 'ton', '21/08/2014'),
                16 => array('fcblouges', 'FC Blouges', 'fbl', '21/08/2014'),
        );

        foreach ($a_teams as $key => $a_team) {
            
            
            for ($i=1; $i<=5; $i++) {
                // We create the player
                $team = $manager->getRepository('FutsalTournamentBundle:Team')->find($key);
                
                $player = new Player();
                $player->setFirstname($a_team[0]."_fn".$i);
                $player->setLastname($a_team[0]."_ln".$i);
                $player->setUsername($a_team[0]."_un".$i);
                $player->setEmail($a_team[0]."_".$i."@email.fr");
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