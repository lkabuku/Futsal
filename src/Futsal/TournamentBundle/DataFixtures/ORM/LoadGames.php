<?php

namespace Futsal\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Futsal\TournamentBundle\Entity\Game;
use Futsal\TournamentBundle\Entity\GameTeam;
//use Futsal\TournamentBundle\Entity\Team;

class LoadGames extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {       
        $matchs = array(
                    0 => array(1, 2),
                    1 => array(3, 4),
                    2 => array(5, 6),
                    3 => array(7, 8),
                );
        
        foreach ($matchs as $match) {                   
            //Get the 2 teams
            $team1 = $manager->getRepository('FutsalTournamentBundle:Team')->find($match[0]);
            $team2 = $manager->getRepository('FutsalTournamentBundle:Team')->find($match[1]);
            
            if(null !== $team1 && null !== $team2) {
                //Add 2 teams in GameTeam
                $gameResult1 = new GameTeam();
                $gameResult1->setTeam($team1);

                $gameResult2 = new GameTeam();
                $gameResult2->setTeam($team2);

                // Add 2 results collection in game
                $game = new Game();
                $game->addGameResult($gameResult1);
                $game->addGameResult($gameResult2);
                
                // Set the id_match for 2 teams
                $gameResult1->setGame($game);
                $gameResult2->setGame($game);
                
                // We persist all
                $manager->persist($gameResult1);
                $manager->persist($gameResult2);
                $manager->persist($game);
            } else {
                echo "IMPOSSIBLE TO GET TEAM".$match[0]." and/or TEAM".$match[1]."\r\n";
            }
        }
        
        // Then we record all
        $manager->flush();
    }

    public function getOrder() {
        return 5;
    }

}
