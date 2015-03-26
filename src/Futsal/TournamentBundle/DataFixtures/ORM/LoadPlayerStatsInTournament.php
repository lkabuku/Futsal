<?php

namespace Futsal\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
//use Futsal\TournamentBundle\Entity\Tournament;

class LoadPlayerStatsInTournament extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // All games
        $games = $manager->getRepository('FutsalTournamentBundle:Game')->findAll();
        
        // We look for one tournament
        //$tournament = $manager->getRepository('FutsalTournamentBundle:Tournament')->find(1);
        
        foreach($games as $game) {
            $gameResults = $game->getGameResults();
            foreach($gameResults as $gameResult) {
                $gameResult->getTeam();
                echo $gameResult->getTeam()->getId();
            }
        }
        
        
        /*
     
        foreach($games as $game) {
            // Add a team in a tournament
            echo $team->getId();
            $tournament->addTeamsSubscribed($team);
        }
        
        // We persist them
        $manager->persist($tournament);
        
        // Then we record all the tournament
        $manager->flush();

        */
    }

    public function getOrder() {
        return 7;
    }

}