<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AuthorizationController extends AbstractController
{
    /**
     * @Route("/authorization")
     */
    public function show()
    {

        return $this->render('authorization.html.twig', [
            'session' => session_id(),
        ]);
    }
    /**
     * @Route("/login")
     */
}
