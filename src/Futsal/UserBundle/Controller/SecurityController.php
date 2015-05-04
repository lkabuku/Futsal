<?php

namespace Futsal\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Security\Core\SecurityContextInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

use Futsal\UserBundle\Entity\User;

class SecurityController extends Controller
{
       
    public function checkAction(Request $request)
    {
        /*
        $username = $request->request->get("username");
        $plaintextPassword = $request->request->get("password");
        
        $user = new User();
        $encoder = $this->container->get('security.password_encoder');
        $password = $encoder->encodePassword($user, $plaintextPassword);
        
        $em = $this->getDoctrine()->getManager();
        $userRepository = $em->getRepository('FutsalUserBundle:User');
        $userRepository->checkUserByUsernameAndPassword($username, $password);
         * 
         */
        return $this->redirectToRoute('futsal_user_homepage');
    }
    
    public function logoutAction(Request $request)
    {
        
    }
}
