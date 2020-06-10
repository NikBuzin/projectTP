<?php
namespace App\Controller;

use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FoodListController extends AbstractController
{
    /**
     * Show food list
     * @Route("/foodList")
     */
    public function number()
    {
        $foods = $this->getDoctrine()->getRepository('App:Food')->findAll();

        return $this->render('foodList.html.twig', [
            'foods' => $foods,
        ]);

    }
}
