<?php
namespace App\Controller;

use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditManagerListController extends AbstractController
{
    /**
     * @Route("/editManagerList")
     */
    public function show(){
        $manager=$this->getDoctrine()->getRepository('App:Manager')->find($_GET['id']);
        return $this->render('editManagerList.html.twig', [
            'manager' => $manager,
        ]);
    }
    /**
     * @Route("/editManagerList/update")
     */
    public function update()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $manager=$this->getDoctrine()->getRepository('App:Manager')->find($_REQUEST['id']);
        if(!$manager){
            throw $this->createNotFoundException(
                'No food found for id'.$_REQUEST['id']
            );
        }
        $manager->setName($_REQUEST['name']);
        $manager->setLogin($_REQUEST['login']);
        $manager->setPassword($_REQUEST['password']);
        $entityManager->flush();
        return $this->redirect('/managersList');
    }

    /**
     * @Route("/removeManagerList")
     */
    public function delete(){
        $entityManager = $this->getDoctrine()->getManager();
        $manager=$this->getDoctrine()->getRepository('App:Manager')->find($_GET['id']);
        $entityManager->remove($manager);
        $entityManager->flush();
        return $this->redirect('/managersList');
    }
}
