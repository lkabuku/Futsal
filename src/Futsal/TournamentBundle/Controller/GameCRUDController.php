<?php
// /src/Futsal/TournamentBundle/GameCRUDController.php
namespace Futsal\TournamentBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Sonata\AdminBundle\Controller\CRUDController;

class GameCRUDController extends CRUDController
{
    
    /**
     * View action
     *
     * @return RedirectResponse
     */
    public function viewAction(Request $request)
    {
        $id = $request->attributes->get("id");
        
        return $this->redirectToRoute("admin_futsal_tournament_game_result_list", array("id" => $id));
    }
    
    /**
     * List action
     *
     * @return Response
     *
     * @throws AccessDeniedException If access is not granted
     */
    public function listAction()
    {
        if (false === $this->admin->isGranted('LIST')) {
            throw new AccessDeniedException();
        }

        $datagrid = $this->admin->getDatagrid();
        $formView = $datagrid->getForm()->createView();
        
        ///$helperListGame = $this->get('templating.helper.listgame');
        //$helperListGame->execute($datagrid->getResults());
        
        // set the theme for the current Admin Form
        $this->get('twig')->getExtension('form')->renderer->setTheme($formView, $this->admin->getFilterTheme());

        return $this->render($this->admin->getTemplate('list'), array(
            'action'     => 'list',
            'form'       => $formView,
            'datagrid'   => $datagrid,
            'csrf_token' => $this->getCsrfToken('sonata.batch'),
        ));
    }
}

