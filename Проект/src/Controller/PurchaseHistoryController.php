<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PurchaseHistoryController extends AbstractController
{
    /**
     * @Route("/purchaseHistory")
     */
    public function show()
    {
        $orders = $this->getDoctrine()->getRepository('App:Order')->findAll();

        return $this->render('purchaseHistory.html.twig', [
            'orders' => $orders,
        ]);
    }
}
