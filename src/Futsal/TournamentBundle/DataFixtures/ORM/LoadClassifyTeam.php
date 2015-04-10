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
                $classifyTeam->setPositionGroup($key);
                
                $nbPoints = $this->treatNbPointsOneTeam($team->getId(), $tournament{$i}->getId(), $group{$i}->getId(), $manager);
                $classifyTeam->setNbPoints($nbPoints);
                
                $goalAgainst = $this->treatGoalsAgainstOneTeam($team->getId(), $tournament{$i}->getId(), $group{$i}->getId(), $em);
                $classifyTeam->setGoalAgainst($goalAgainst);
                
                $goalFor = $this->treatGoalsForOneTeam($team->getId(), $tournament{$i}->getId(), $group{$i}->getId(), $em);
                $classifyTeam->setGoalFor($goalFor);
                
                // We persist it
                $manager->persist($classifyTeam);
            }
        }
        
        // Then we record all
        $manager->flush();
        
        $this->classifyTeam(1, 1, $manager);
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
                        SELECT r.id 
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
            ->where('u.game IN (SELECT '.new Expr\Select(array('r.game')).' FROM '.new Expr\From('Futsal\TournamentBundle\Entity\Result', 'r').' WHERE r.team = :teamId AND r.group = :groupId AND r.tournament = :tournamentId)')
            ->andWhere($qb->expr()->not($qb->expr()->eq('u.team', $idTeam)))
            ->andWhere('u.team != :teamId')
            ->setParameter("teamId", $idTeam)
            ->setParameter("groupId", $idGroup)
            ->setParameter("tournamentId", $idTournament);
        $query = $qb->getQuery();

        $result = $query->getResult(Query::HYDRATE_SINGLE_SCALAR);

        //echo "goal against :".$result." / team id : ".$idTeam." / group : ".$idGroup." / tournament : ".$idTournament."\r\n";
        echo $query->getSQL();echo "\r\n";
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
    
    
    /* Returns an array of classified team */
    public function classifyTeam($idTournament, $idGroup, ObjectManager $manager)
    {
        $allTeamsClassified = $manager->getRepository('FutsalTournamentBundle:ClassifyTeam')->findBy(
                                                                                            array(
                                                                                                'tournament' => $idTournament,
                                                                                                'groups' => $idGroup,
                                                                                            )
                                                                                        );

        usort($allTeamsClassified, "static::compare");
        //
        //$manager->persist($allTeamsClassified);
        
        // Then we record all
        //$manager->flush();
        
        return $allTeamsClassified;
    }
    
    /* Compares some properties of an array */
    private static function compare($a, $b) {
        //echo var_dump($a->getNbPoints());echo "/";
        if ($a->getNbPoints() === $b->getNbPoints()) {
            return 0;
        }
        
        return ($a->getNbPoints() < $b->getNbPoints()) ? -1 : 1;
    }

    public function getOrder() {
        return 9;
    }

}