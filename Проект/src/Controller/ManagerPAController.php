<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ManagerPAController extends AbstractController
{
    /**
     * Show manager account
     * @Route("/managerPA")
     */
    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('managerPA.html.twig', [
            'number' => $number,
        ]);
    }
}
