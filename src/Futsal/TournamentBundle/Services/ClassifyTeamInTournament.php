<?php
namespace Futsal\TournamentBundle\Services;

/**
 * Description of ClassifyTeamInTournament
 *
 * @author Lucien KABUKU
 */
class ClassifyTeamInTournament {
    
    var $em;
    var $classifiedTeams;
    var $nbPoints;
    
    CONST WINPOINTS =  3;
    CONST DRAWPOINTS = 1;
    CONST LOSSPOINTS = 0;
    
    public function __construct(EntityManager $em) {
        $this->em = $em;
    }
    
    public function generateClassify()
    {
        
    }
    
    public function generateResultsTeam($idTeam, $idTournament, $idGroup)
    {
        $resultsOneTeam = $this->em->getRepository('FutsalTournamentBundle:Results')->findBy(
                                                                            array('team' => $idTeam),
                                                                            array('tournament' => $idTournament),
                                                                            array('group' => $idGroup)
                                                                            );
        $nbWins = 0;
        $nbLoss = 0;
        $nbDraw = 0;
        
        foreach($resultsOneTeam as $resultOneTeam) {
            if($resultOneTeam->getResult() === "V") {
                $nbWins++;
            } elseif ($resultOneTeam->getResult() === "N") {
                $nbLoss++;
            } else {
                $nbDraw++;
            }
        }
        
        $nbPoints = WINPOINTS*$nbWins + DRAWPOINTS*$nbDraw + LOSSPOINTS*$nbLoss;
    }
    
}
