<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * @Route("/cart")
     */
    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('cart.html.twig', [
            'number' => $number,
        ]);
    }
}

