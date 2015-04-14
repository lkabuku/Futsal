<?php
// src/Futsal/TournamentBundle/Helper/Admin/ListResultHelper.php
namespace Futsal\TournamentBundle\Helper\Admin;

use Symfony\Component\Templating\Helper\Helper;

class ListResultHelper extends Helper
{
    public function getName()
    {
        return 'ListResultHelper';
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
