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
                    0 => array(1, 2, "Tony Chapron",0),
                    1 => array(3, 4, "Saïd Ennjimi",0),
                    2 => array(5, 6, "Clément Turpin",1),
                    3 => array(7, 8, "Stéphane Lannoy",1),
                    4 => array(9, 10, "Philippe Kalt",0),
                    5 => array(11, 12, "Lionel Jaffredo",1),
                    6 => array(13, 14, "Frédy Fautrel",0),
                    7 => array(15, 16, "Wilfried Bien",1),
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
                $game->setReferee($match[2]);
                $game->setIsValid($match[3]);
                
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
