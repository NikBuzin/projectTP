<?php

namespace App\Controller;
use App\Entity\Manager;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddToStashController extends AbstractController
{
    /**
     * Adding a dish to the basket
     * @Route("/addToStash")
     */
    public function addToStash()
    {
        session_start();
        $foods = $this->getDoctrine()->getRepository('App:Food')->findAll();
        $food = $this->getDoctrine()->getRepository('App:Food')->find($_GET['id']);
        if (!$food) {
            throw $this->createNotFoundException(
                'No food found for id '.$_GET['id']
            );
        }
        $_SESSION['stash'][] = $_GET['id'];
        array_unique($_SESSION['stash']);
        return $this->render('home.html.twig', [
            'foods' => $foods,
            'foodStash' => $food,
        ]);
    }
}
