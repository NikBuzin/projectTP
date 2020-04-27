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
    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('authorization.html.twig', [
            'number' => $number,
        ]);
    }
}
