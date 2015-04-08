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
                
                
                // Add stats for players
                $nbGoalsByTeam = $this->treatPlayersStats($playersOneTeam, $tournament, $game, $manager);
                
                /*
                // Add Stats for players
                $nbGoalsByTeam = 0;
                
                foreach($playersOneTeam as $player) {
                    $nbGoals = rand(0, 10);
                    $nbGoalsByTeam += $nbGoals;
                    
                    $tournamentPlayerStats = new TournamentPlayerStats();
                    $tournamentPlayerStats->setPlayer($player);
                    $tournamentPlayerStats->setTournament($tournament);
                    $tournamentPlayerStats->setGame($game);
                    $tournamentPlayerStats->setNbGoals($nbGoals);
                    
                    // We persist id
                    $manager->persist($tournamentPlayerStats);
                }
                */
                
                $idResult = $gameResult->getId();
                $oneResult = $manager->getRepository('FutsalTournamentBundle:Result')->find($idResult);
                $oneResult->setGoals($nbGoalsByTeam);
            }
        }
        
        // Then we record all
        $manager->flush();
    }
    
    protected function treatPlayersStats($playersOneTeam, $tournament, $game, ObjectManager $manager)
    {
        // Add Stats for players
        $nbGoalsByTeam = 0;
        
        foreach($playersOneTeam as $player) {
            $nbGoals = rand(0, 10);
            $nbGoalsByTeam += $nbGoals;

            $tournamentPlayerStats = new TournamentPlayerStats();
            $tournamentPlayerStats->setPlayer($player);
            $tournamentPlayerStats->setTournament($tournament);
            $tournamentPlayerStats->setGame($game);
            $tournamentPlayerStats->setNbGoals($nbGoals);

            // We persist id
            $manager->persist($tournamentPlayerStats);
        }
        
        return $nbGoalsByTeam;
    }
    
    public function getOrder() {
        return 7;
    }

}