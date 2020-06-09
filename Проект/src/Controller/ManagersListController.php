<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ManagersListController extends AbstractController
{
    /**
     * @Route("/managersList")
     */
    public function show()
    {
        $managers = $this->getDoctrine()->getRepository('App:Manager')->findAll();

        return $this->render('managersList.html.twig', [
            'managers' => $managers,
        ]);

    }
}
