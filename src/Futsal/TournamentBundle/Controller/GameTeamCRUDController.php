<?php
// /src/Futsal/TournamentBundle/GameTeamCRUDController.php
namespace Futsal\TournamentBundle\Controller;

use Sonata\AdminBundle\Controller\CRUDController;

class GameTeamCRUDController extends CRUDController
{    
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
        
        //$helperListGameTeam = $this->get('templating.helper.listgameteam');
        //$helperListGameTeam->execute($datagrid->getResults());
        
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

