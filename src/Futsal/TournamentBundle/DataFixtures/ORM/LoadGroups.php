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
        $group = new Groups();
        $group->setNbQualifiedTeams(4);
        
        // We persist it
        $manager->persist($group);
        
        // Then we record all
        $manager->flush();
    }

    public function getOrder() {
        return 8;
    }

}