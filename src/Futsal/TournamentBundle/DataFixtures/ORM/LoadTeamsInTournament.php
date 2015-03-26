<?php

namespace Futsal\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
//use Futsal\TournamentBundle\Entity\Tournament;

class LoadTeamsInTournament extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        // All teams
        $teams = $manager->getRepository('FutsalTournamentBundle:Team')->findAll();
        
        // We look for one tournament
        $tournament = $manager->getRepository('FutsalTournamentBundle:Tournament')->find(1);
        
        foreach($teams as $team) {
            // Add a team in a tournament
            $tournament->addTeamsSubscribed($team);
        }
        
        // We persist them
        $manager->persist($tournament);
        
        // Then we record all the tournament
        $manager->flush();
    }

    public function getOrder() {
        return 6;
    }

}