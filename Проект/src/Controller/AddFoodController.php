<?php

namespace App\Controller;
use App\Entity\Food;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddFoodController extends AbstractController
{
    /**
     * @Route("/addFood")
     */
    public function number()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $food = new Food();
        $food->setName($_REQUEST['title']);
        $food->setDescription($_REQUEST['description']);
        $food->setPrice($_REQUEST['price']);
        $entityManager->persist($food);
        $entityManager->flush();
        return $this->redirect("/foodList");
    }
}