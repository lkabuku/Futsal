<?php
// src/Futsal/TournamentBundle/Helper/Admin/ListGameTeamHelper.php
namespace Futsal\TournamentBundle\Helper\Admin;

use Symfony\Component\Templating\Helper\Helper;

class ListGameTeamHelper extends Helper
{
    public function getName()
    {
        return 'ListGameTeamHelper';
    }
    

    public function execute($data) {
        
        $results = $data;
        
        foreach($results as $result) {
            echo $result->getId();
            echo $result->getGoals();
            echo $result->getGame()->getId();
            echo $result->getGame()->getReferee();
            echo $result->getGame()->getDate();
            echo $result->getGame()->getIsValid();
            //var_dump($result->getGame()->getGameResults()->toArray());
        }
        
        return "";
    }

}
