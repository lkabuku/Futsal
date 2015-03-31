<?php
// /src/Futsal/TournamentBundle/GameCRUDController.php
namespace Futsal\TournamentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sonata\AdminBundle\Controller\CRUDController;

class GameCRUDController extends CRUDController
{
    
    public function viewAction(Request $request)
    {
        $id = $request->attributes->get("id");
        return $this->redirectToRoute("admin_futsal_tournament_game_gameteam_list", array("id" => $id));
    }
}

