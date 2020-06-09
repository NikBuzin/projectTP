<?php
namespace App\Controller;

use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditFoodListController extends AbstractController
{
    /**
     * @Route("/editFoodList")
     */
    public function show(){
        $food=$this->getDoctrine()->getRepository('App:Food')->find($_GET['id']);
        return $this->render('editFoodList.html.twig', [
            'food' => $food,
        ]);
    }
    /**
     * @Route("/editFoodList/update")
     */
    public function update()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $food=$this->getDoctrine()->getRepository('App:Food')->find($_REQUEST['id']);
        if(!$food){
            throw $this->createNotFoundException(
                'No food found for id'.$_REQUEST['id']
            );
        }
        $food->setName($_REQUEST['title']);
        $food->setDescription($_REQUEST['description']);
        $food->setPrice($_REQUEST['price']);
        $entityManager->flush();
        return $this->redirect('/foodList');
    }

    /**
     * @Route("/removeFoodList")
     */
    public function delete(){
        $entityManager = $this->getDoctrine()->getManager();
        $food=$this->getDoctrine()->getRepository('App:Food')->find($_GET['id']);
        $entityManager->remove($food);
        $entityManager->flush();
        return $this->redirect('/foodList');
    }
}
