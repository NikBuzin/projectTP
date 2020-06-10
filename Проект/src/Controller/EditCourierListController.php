<?php
namespace App\Controller;

use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditCourierListController extends AbstractController
{
    /**
     * Redirect to edit page
     * @Route("/editCourierList")
     */
    public function show(){
        $courier=$this->getDoctrine()->getRepository('App:Courier')->find($_GET['id']);
        return $this->render('editCourierList.html.twig', [
            'courier' => $courier,
        ]);
    }
    /**
     * Сourier information update
     * @Route("/editCourierList/update")
     */
    public function update()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $courier=$this->getDoctrine()->getRepository('App:Courier')->find($_REQUEST['id']);
        if(!$courier){
            throw $this->createNotFoundException(
                'No food found for id'.$_REQUEST['id']
            );
        }
        $courier->setName($_REQUEST['name']);
        $courier->setLogin($_REQUEST['login']);
        $courier->setPassword($_REQUEST['password']);
        $entityManager->flush();
        return $this->redirect('/couriersList');
    }

    /**
     * Courier information remove
     * @Route("/removeCourierList")
     */
    public function delete(){
        $entityManager = $this->getDoctrine()->getManager();
        $courier=$this->getDoctrine()->getRepository('App:Courier')->find($_GET['id']);
        $entityManager->remove($courier);
        $entityManager->flush();
        return $this->redirect('/couriersList');
    }
}
