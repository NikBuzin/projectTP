<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourierListController extends AbstractController
{
    /**
     * Show list couriers
     * @Route("/couriersList")
     */
    public function show()
    {
        $couriers = $this->getDoctrine()->getRepository('App:Courier')->findAll();

        return $this->render('couriersList.html.twig', [
            'couriers' => $couriers,
        ]);

    }
}
