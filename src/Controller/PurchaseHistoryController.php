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
    public function number()
    {
        $number = random_int(0, 100);

        return $this->render('purchaseHistory.html.twig', [
            'number' => $number,
        ]);
    }
}
