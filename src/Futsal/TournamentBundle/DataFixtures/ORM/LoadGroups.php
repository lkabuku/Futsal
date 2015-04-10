<?php

namespace Futsal\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Futsal\TournamentBundle\Entity\Groups;

class LoadGroups extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $group1 = new Groups();
        $group1->setNbQualifiedTeams(4);
                 
        $group2 = new Groups();
        $group2->setNbQualifiedTeams(4);
        
        // We persist it
        $manager->persist($group1);
        $manager->persist($group2);
        
        // Then we record all
        $manager->flush();
    }

    public function getOrder() {
        return 1;
    }

}