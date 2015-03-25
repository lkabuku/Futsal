<?php

namespace Futsal\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Futsal\UserBundle\Entity\User;

class SecurityController extends Controller
{
    
    public function loginAction(Request $request)
    {
        // Si le visiteur est déjà identifié, on le redirige vers l'accueil
        /*
        if ($this->get('security.context')->isGranted('IS_AUTHENTICATED_REMEMBERED')) {            
            return $this->redirect($this->generateUrl('futsal_user_admin_homepage'));
        }
        */
        
        $session = $request->getSession();
        
        // On vérifie s'il y a des erreurs d'une précédente soumission du formulaire
        if ($request->attributes->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $request->attributes->get(SecurityContextInterface::AUTHENTICATION_ERROR);
        } elseif (null !== $session && $session->has(SecurityContextInterface::AUTHENTICATION_ERROR)) {
            $error = $session->get(SecurityContextInterface::AUTHENTICATION_ERROR);
            $session->remove(SecurityContextInterface::AUTHENTICATION_ERROR);
        } else {
            $error = '';
        }

        $lastUsername = (null === $session) ? '' : $session->get(SecurityContextInterface::LAST_USERNAME);
        
        return $this->render('FutsalUserBundle:Security:login.html.twig', array(
            // Valeur du précédent nom d'utilisateur entré par l'internaute
            'last_username' => $lastUsername,
            'error'         => $error,
        ));
    }
    
    public function loginCheckAction(Request $request)
    {
        $username = $request->request->get("username");
        $plaintextPassword = $request->request->get("password");
        
        $user = new User();
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, $plaintextPassword);
        
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('FutsalUserBundle:User');
        $userRepository->checkUserByUsernameAndPassword($username, $password);
    }
    
    public function logoutAction(Request $request)
    {
        
    }
    
    public function adminAction(Request $request)
    {
        return new Response("Admin Section !");
    }
}
