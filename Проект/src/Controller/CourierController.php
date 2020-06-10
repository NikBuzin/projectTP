<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CourierController extends AbstractController
{
    /**
     * Show couriers
     * @Route("/courier")
     */
    public function number()
    {

        return $this->render('courier.html.twig');
    }
}
