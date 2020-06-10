<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class CartController extends AbstractController
{
    /**
     * Shows sales order

     * @Route("/cart")
     */
    public function show()
    {
        session_start();
        dump($_SESSION['stash']);
        foreach ($_SESSION['stash'] as $id) {
            $foods[] = $this->getDoctrine()->getRepository('App:Food')->find((int)$id);
        }
        return $this->render('cart.html.twig', [
            'session' => session_id(),
            'foods' => $foods,
        ]);
    }
    /**
     * Removes an item from an order.
     * @Route("/deleteFoodFromStash")
     */
    public function deleteFood(){
        session_start();
        foreach ($_SESSION['stash'] as $order){
            unset($_SESSION['stash'][array_search($_GET['id'] , $_SESSION['stash'])]);
        }
        dump($_SESSION['stash']);
        foreach ($_SESSION['stash'] as $id) {
            $foods[] = $this->getDoctrine()->getRepository('App:Food')->find((int)$id);
        }
        if(empty($foods)){
            return $this->redirect('/');
        }
        return $this->render('cart.html.twig', [
            'session' => session_id(),
            'foods' => $foods,
        ]);
    }

}

