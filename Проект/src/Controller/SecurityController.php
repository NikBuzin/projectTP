<?php

namespace App\Controller;

use App\Entity\Manager;
use App\Entity\Courier;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class SecurityController extends AbstractController
{
    /**
     * @Route("/login")
     */
    public function login()
    {
        $managers = $this->getDoctrine()->getRepository('App:Manager');
        dump($managers);
        $manager = $managers->findOneBy([
            'login'=>$_REQUEST['login'],
            'password'=>$_REQUEST['password'],
        ]);
        $couriers = $this->getDoctrine()->getRepository('App:Courier')->findOneBy([
            'login'=>$_REQUEST['login'],
            'password'=>$_REQUEST['password'],
        ]);

        if(!$manager){
            $this->redirect('/authorization');
        }
        else{
            return $this->render('managerPA.html.twig', [
                'manager' => $manager,
                'session' => session_id(),
            ]);
        }
        if(!$couriers){
            $this->redirect('/authorization');
        }
        else{
            return $this->render('courier.html.twig', [
                'courier' => $couriers
            ]);
        }
    }

    /**
     * @Route("/logout", name="app_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }
}
