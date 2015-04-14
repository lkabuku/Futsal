<?php

namespace Futsal\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Futsal\TournamentBundle\Entity\ClassifyTeam;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Doctrine\ORM\Query;
use Doctrine\ORM\Query\Expr;

class LoadClassifyTeam extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{   
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * {@inheritDoc}
     */
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $em = $this->container->get('doctrine.orm.entity_manager');

        $nbTournamentAndGroup = 2;
        
        for($i=1;$i<=$nbTournamentAndGroup;$i++) {
            // We look for one tournament
            $tournament{$i} = $manager->getRepository('FutsalTournamentBundle:Tournament')->find($i);

            // We look for one group
            $group{$i} = $manager->getRepository('FutsalTournamentBundle:Groups')->find($i);

            // All games
            $limit = 8;
            $offset = ( $i - 1 ) * $limit;
            $teams = $manager->getRepository('FutsalTournamentBundle:Team')->findBy([], null, $limit, $offset);

            foreach($teams as $key => $team) {
                $key++;
                $classifyTeam = new ClassifyTeam();
                $classifyTeam->setGroups($group{$i});
                $classifyTeam->setTeam($team);
                $classifyTeam->setTournament($tournament{$i});
                //$classifyTeam->setPositionGroup($key);
                
                $nbPoints = $this->treatNbPointsOneTeam($team->getId(), $tournament{$i}->getId(), $group{$i}->getId(), $manager);
                $classifyTeam->setNbPoints($nbPoints);
                
                $goalAgainst = $this->treatGoalsAgainstOneTeam($team->getId(), $tournament{$i}->getId(), $group{$i}->getId(), $em);
                $classifyTeam->setGoalAgainst($goalAgainst);
                
                $goalFor = $this->treatGoalsForOneTeam($team->getId(), $tournament{$i}->getId(), $group{$i}->getId(), $em);
                $classifyTeam->setGoalFor($goalFor);
                
                $goalDiff = $goalFor - $goalAgainst;
                //Test de la difference à retirer
                /*
                if($nbPoints === 6) {
                    $goalDiff = 10;
                }
                 * 
                 */
                $classifyTeam->setGoalDifference($goalDiff);
                
                // We persist it
                $manager->persist($classifyTeam);
                $manager->flush();
            }
            
            $this->classifyTeam($tournament{$i}, $group{$i}, $manager);
        }
        
        // Then we record all
        //$manager->flush();
    }
    
    /* Set points to all team */
    public function treatNbPointsOneTeam($idTeam, $idTournament, $idGroup, ObjectManager $manager)
    {
        $resultsOneTeam = $manager->getRepository('FutsalTournamentBundle:Result')->findBy(
                                                                                            array(
                                                                                                'team' => $idTeam,
                                                                                                'tournament' => $idTournament,
                                                                                                'group' => $idGroup,
                                                                                            )
                                                                                        );
        $nbWins = 0;
        $nbLoss = 0;
        $nbDraw = 0;
        
        foreach($resultsOneTeam as $resultOneTeam) {
            if($resultOneTeam->getResult() === "V") {
                $nbWins++;
            } elseif ($resultOneTeam->getResult() === "N") {
                $nbDraw++;
            } elseif ($resultOneTeam->getResult() === "D") {
                $nbLoss++;
            }
        }
        
        $nbPoints = 3*$nbWins + 1*$nbDraw + 0*$nbLoss;
        
        return $nbPoints;
    }
    
    protected function treatGoalsAgainstOneTeam($idTeam, $idTournament, $idGroup, $em)
    {
        /*
        $querySql = "
                    SELECT SUM(g.goals)
                    FROM Futsal\TournamentBundle\Entity\Result g
                    WHERE g.game IN (
                        SELECT IDENTITY(r.game)
                        FROM Futsal\TournamentBundle\Entity\Result r
                        WHERE r.team = :teamId
                        AND r.group = :groupId
                        AND r.tournament = :tournamentId
                    )
                    AND g.team != :teamId
                ";
        
        $query = $em->createQuery($querySql);
        $query->setParameters(
                                array(
                                    'teamId' => $idTeam,
                                    'groupId' => $idGroup,
                                    'tournamentId' => $idTournament,
                                )
                            );
        $result = $query->getResult(Query::HYDRATE_SINGLE_SCALAR);
        */
        
        // $qb instanceof QueryBuilder
        $qb = $em->createQueryBuilder();
        $qb->select('sum(u.goals) as goals')
            ->from('Futsal\TournamentBundle\Entity\Result', 'u')
            ->where('u.game IN (SELECT IDENTITY(r.game) FROM '.new Expr\From('Futsal\TournamentBundle\Entity\Result', 'r').' WHERE r.team = :teamId AND r.group = :groupId AND r.tournament = :tournamentId)')
            ->andWhere($qb->expr()->not($qb->expr()->eq('u.team', $idTeam)))
            ->andWhere('u.team != :teamId')
            ->setParameter("teamId", $idTeam)
            ->setParameter("groupId", $idGroup)
            ->setParameter("tournamentId", $idTournament);
        $query = $qb->getQuery();

        $result = $query->getResult(Query::HYDRATE_SINGLE_SCALAR);

        //echo $query->getSQL();echo "\r\n";
        return $result;
    }
    
    protected function treatGoalsForOneTeam($idTeam, $idTournament, $idGroup, $em) {   
        $qb = $em->createQueryBuilder();
        $qb->select('sum(u.goals) as goals')
            ->from('Futsal\TournamentBundle\Entity\Result', 'u')
            ->where('u.team = :teamId')
            ->andWhere('u.group = :groupId')
            ->andWhere('u.tournament = :tournamentId')
            ->setParameter("teamId", $idTeam)
            ->setParameter("groupId", $idGroup)
            ->setParameter("tournamentId", $idTournament);
        $query = $qb->getQuery();
        
        $result = $query->getResult(Query::HYDRATE_SINGLE_SCALAR);
        
        return $result;
    }
    
    /*
    protected function treatGoalsDifferenceForOneTeam($idTeam, $idTournament, $idGroup, $em) {   
        $qb = $em->createQueryBuilder();
        $qb->select('u.goalFor')
            ->from('Futsal\TournamentBundle\Entity\ClassifyTeam', 'u')
            ->where('u.team = :teamId')
            ->andWhere('u.groups = :groupId')
            ->andWhere('u.tournament = :tournamentId')
            ->setParameter("teamId", $idTeam)
            ->setParameter("groupId", $idGroup)
            ->setParameter("tournamentId", $idTournament);
        $query = $qb->getQuery();
        
        $result = $query->getResult(Query::HYDRATE_SINGLE_SCALAR);
        echo $query->getSQL();echo "\r\n";
        exit;
        return $result;
    }
    */
    
    /* Returns an array of classified team */
    public function classifyTeam($tournament, $group, ObjectManager $manager)
    {
        $idTournament = $tournament->getId();
        $idGroup = $group->getId();
        $allTeamsClassified = $manager->getRepository('FutsalTournamentBundle:ClassifyTeam')->findBy(
                                                                                            array(
                                                                                                'tournament' => $idTournament,
                                                                                                'groups' => $idGroup,
                                                                                            )
                                                                                        );

        usort($allTeamsClassified, "static::compare");
        
        foreach($allTeamsClassified as $key => $teamClassified) {
            //echo $teamClassified->getTeam()->getName()." - ".$teamClassified->getNbPoints()." pts \r\n";
            $classifyTeam = $manager->getRepository('FutsalTournamentBundle:ClassifyTeam')->findOneBy(
                                                                                            array(
                                                                                                'tournament' => $idTournament,
                                                                                                'groups' => $idGroup,
                                                                                                'team' => $teamClassified->getTeam()->getId()
                                                                                            )
                                                                                        );
            $position = $key+1;
            $classifyTeam->setPositionGroup($position);
            
            $manager->persist($classifyTeam);
        }
        
        $manager->flush();
    }
    
    /* Compares some properties of an array */
    private static function compare($a, $b) {
        //echo "Id Team A : ".$a->getId()." - ".$a->getNbPoints()."/ Id Team B :".$b->Id()." - ".$b->getNbPoints()."\r\n";
        
        if (
                //Perfect egality
                ( $a->getNbPoints() === $b->getNbPoints() ) && 
                ( $a->getGoalDifference() === $b->getGoalDifference() ) && 
                ( $a->getGoalFor() === $b->getGoalFor() ) 
            ) {
            $compareReturn = 0;
        } elseif (
                    //Egality on the number of points but not on the goal difference
                    ( $a->getNbPoints() === $b->getNbPoints() ) &&
                    ( $a->getGoalDifference() > $b->getGoalDifference() )
                ) {
           $compareReturn = -1;
        } elseif (
                    //Egality on the number of points, the goal difference but not on the goal for
                    ( $a->getNbPoints() === $b->getNbPoints() ) &&
                    ( $a->getGoalDifference() === $b->getGoalDifference() ) && 
                    ( $a->getGoalFor() > $b->getGoalFor() ) 
                ) {
            $compareReturn = -1;
        } else if( $a->getNbPoints() > $b->getNbPoints() ) {
            //Team A got more points than Team B
            $compareReturn = -1;
        } else {
            $compareReturn = 1;
        }
        
        return $compareReturn;
    }

    public function getOrder() {
        return 9;
    }

}