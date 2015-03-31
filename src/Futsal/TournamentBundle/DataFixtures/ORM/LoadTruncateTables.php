<?php

namespace Futsal\TournamentBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadTruncateTables extends AbstractFixture implements OrderedFixtureInterface
{
    public function load(ObjectManager $manager)
    {       
        $entities = array("Game", "GameTeam", "Player", "Team", "Tournament", "TournamentPlayerStats", "Groups", "ClassifyTeam", "TournamentTeam");
        
        foreach($entities as $entity) {
            $cmd = $manager->getClassMetadata("Futsal\TournamentBundle\Entity\\".$entity);
            $connection = $manager->getConnection();
            $dbPlatform = $connection->getDatabasePlatform();
            $connection->query('SET FOREIGN_KEY_CHECKS=0');
            $q = $dbPlatform->getTruncateTableSql($cmd->getTableName());
            $connection->executeUpdate($q);
            $connection->query('SET FOREIGN_KEY_CHECKS=1');
        }
    }

    public function getOrder() {
        return 1;
    }

}
