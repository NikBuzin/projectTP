<?php

namespace App\Controller;
use App\Entity\Courier;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddCourierController extends AbstractController
{
    /**
     * @Route("/addCourier")
     */
    public function number()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $courier = new Courier();
        $courier->setName($_REQUEST['name']);
        $courier->setLogin($_REQUEST['login']);
        $courier->setPassword($_REQUEST['password']);
        $entityManager->persist($courier);
        $entityManager->flush();
        return $this->redirect("/couriersList");
    }
}