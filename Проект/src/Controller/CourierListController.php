<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourierListController extends AbstractController
{
    /**
     * @Route("/couriersList")
     */
    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('couriersList.html.twig', [
            'number' => $number,
        ]);
    }
}
