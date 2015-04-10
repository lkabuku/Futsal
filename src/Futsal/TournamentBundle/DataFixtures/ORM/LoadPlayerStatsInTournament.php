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
            
            $results = array();
            
            foreach($gameResults as $gameResult) {
                //Get id of a team
                $gameResult->getTeam();
                $idTeam =  $gameResult->getTeam()->getId();
                
                // Get all players who belong to a team
                $playersOneTeam = $manager->getRepository('FutsalTournamentBundle:Player')->findByTeam($idTeam);
                
                
                // Add stats for players
                $nbGoalsByTeam = $this->treatPlayersStats($playersOneTeam, $tournament, $game, $manager);
                
                $idResult = $gameResult->getId();
                $oneResult = $manager->getRepository('FutsalTournamentBundle:Result')->find($idResult);
                $oneResult->setGoals($nbGoalsByTeam);
                
                $results[] = array(
                                    "id_result" => $idResult, 
                                    "nb_goals" => $nbGoalsByTeam
                                    );
            }
            
            $this->treatResultBetweenTwoTeams($results, $game, $manager);
        }
        
        // Then we record all
        $manager->flush();
    }
    
    protected function treatResultBetweenTwoTeams($results, $game, $manager)
    {
        
        $gameResults = $game->getGameResults();
        
        if(count($gameResults) === 2) {
            $results[0]["result"] = "N";
            $results[1]["result"] = "N";
            if($results[0]["nb_goals"] > $results[1]["nb_goals"]) {
                $results[0]["result"] = "V";
                $results[1]["result"] = "D";
            } elseif ($results[0]["nb_goals"] < $results[1]["nb_goals"]) {
                $results[0]["result"] = "D";
                $results[1]["result"] = "V";
            }
            
            foreach($gameResults as $key => $gameResult) {
                $idResult = $gameResult->getId();
                $oneResult = $manager->getRepository('FutsalTournamentBundle:Result')->find($idResult);
                $oneResult->setResult($results[$key]["result"]);
            }
        } else {
            $game->setIsValid(0);
        }

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