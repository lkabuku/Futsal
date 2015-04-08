<?php

namespace Futsal\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Futsal\TournamentBundle\Entity\ClassifyTeam;

class LoadClassifyTeam extends AbstractFixture implements OrderedFixtureInterface
{
    /*
    public function load(ObjectManager $manager)
    {
        // We look for one tournament
        $tournament = $manager->getRepository('FutsalTournamentBundle:Tournament')->find(1);
        
        // All
        $groups = $manager->getRepository('FutsalTournamentBundle:Groups')->findAll();
        
        foreach($groups as $group) {
            // All games
            $teams = $manager->getRepository('FutsalTournamentBundle:Team')->findAll();

            foreach($teams as $key => $team) {
                $key++;
                if ( ($group->getId() === 1 && $key < 7) || ($group->getId() === 2 && $key > 6) ) {
                    $classifyTeam = new ClassifyTeam();
                    $classifyTeam->setGroups($group);
                    $classifyTeam->setTeam($team);
                    $classifyTeam->setTournament($tournament);
                    $classifyTeam->setPositionGroup($key);

                    // We persist it
                    $manager->persist($classifyTeam);
                }
            }
        }
        
        // Then we record all
        $manager->flush();
    }
    */
    
    public function load(ObjectManager $manager)
    {
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

                // We persist it
                $manager->persist($classifyTeam);
            }
        }
        
        // Then we record all
        $manager->flush();
    }
    
    public function getOrder() {
        return 9;
    }

}