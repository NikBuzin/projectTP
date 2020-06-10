<?php

namespace App\Controller;
use App\Entity\Manager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddManagerController extends AbstractController
{
    /**
     * Add managers to database
     * @Route("/addManager")
     */
    public function addManager()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $manager = new Manager();
        $manager->setRoles(['ROLE_MANAGER']);
        $manager->setName($_REQUEST['name']);
        $manager->setLogin($_REQUEST['login']);
        $manager->setPassword($_REQUEST['password']);
        $entityManager->persist($manager);
        $entityManager->flush();
        return $this->redirect("/managersList");
    }
}
