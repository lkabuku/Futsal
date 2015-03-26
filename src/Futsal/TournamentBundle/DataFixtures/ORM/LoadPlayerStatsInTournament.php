<?php

namespace Futsal\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Futsal\TournamentBundle\Entity\TournamentPlayerStats;

class LoadPlayerStatsInTournament extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // All games
        $games = $manager->getRepository('FutsalTournamentBundle:Game')->findAll();
        
        // We look for one tournament
        $tournament = $manager->getRepository('FutsalTournamentBundle:Tournament')->find(1);
        
        foreach($games as $game) {
            $gameResults = $game->getGameResults();
            
            foreach($gameResults as $gameResult) {
                //Get id of a team
                $gameResult->getTeam();
                $idTeam =  $gameResult->getTeam()->getId();
                
                // Get all players who belong to a team
                $playersOneTeam = $manager->getRepository('FutsalTournamentBundle:Player')->findByTeam($idTeam);
                
                // Add Stats for players
                foreach($playersOneTeam as $player) {
                    $tournamentPlayerStats = new TournamentPlayerStats();
                    $tournamentPlayerStats->setPlayer($player);
                    $tournamentPlayerStats->setTournament($tournament);
                    $tournamentPlayerStats->setGame($game);
                    $tournamentPlayerStats->setNbGoals(rand(0, 10));
                    
                    // We persist id
                    $manager->persist($tournamentPlayerStats);
                }
            }
        }
        
        // Then we record all
        $manager->flush();
    }

    public function getOrder() {
        return 7;
    }

}