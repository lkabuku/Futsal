<?php
// src/Futsal/TournamentBundle/Helper/Admin/ListGameHelper.php
namespace Futsal\TournamentBundle\Helper\Admin;

use Symfony\Component\Templating\Helper\Helper;

class ListGameHelper extends Helper
{
    public function getName()
    {
        return 'ListGameHelper';
    }
    

    public function execute($data) {

        $games = $data;
        
        foreach($games as $game) {
            
            echo "Match : ".$game->getId()." | ";
            $results = $game->getGameResults()->toArray();
            foreach($results as $result) {
                echo "Goals".$result->getGoals()." | ";
            }
            echo $result->getGoals();
            echo $result->getGame()->getId();
            echo $result->getGame()->getReferee();
            echo $result->getGame()->getDate();
            echo $result->getGame()->getIsValid();
            
            //var_dump($game->getGameResults()->toArray());
        }
        
        return "ok";
    }

}
