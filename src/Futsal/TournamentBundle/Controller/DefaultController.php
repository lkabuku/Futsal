<?php

namespace Futsal\TournamentBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('FutsalTournamentBundle:Default:index.html.twig', array('name' => $name));
    }
}
