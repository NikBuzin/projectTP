<?php

namespace App\Controller;
use App\Entity\Order;
use phpDocumentor\Reflection\Types\Integer;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddOfferController extends AbstractController
{
    /**
     * Add orders to database
     * @Route("/addOffer")
     */
    public function addOffer()
    {
        session_start();
        $sum = 0;
        $descr="";
        for($i=0;$i<count($_SESSION['stash']); $i++){
            $sum+=$this->getDoctrine()->getRepository('App:Food')->find($_SESSION['stash'][$i])->getPrice()*$_REQUEST[$_SESSION['stash'][$i]];
            $foods[] = $this->getDoctrine()->getRepository('App:Food')->find($_SESSION['stash'][$i])->getPrice();
            $descr.=$this->getDoctrine()->getRepository('App:Food')->find($_SESSION['stash'][$i])->getName()." ";
        }
        $entityManager = $this->getDoctrine()->getManager();
        $order = new Order();

        $order->setDescription("Блюда:".$descr." Сумма: ".$sum." ФИО:".$_REQUEST['FIO']." Номер: ".$_REQUEST['Number']);
        $order->setAdress($_REQUEST['adres']);
        $order->setStatus("New");
        $entityManager->persist($order);
        $entityManager->flush();
        $_SESSION['stash'] = array();
        return $this->redirect("/");
    }
    /**
     * Cancel order
     * @Route("/cancelOffer")
     */
     public function cancelOffer(){
         session_start();
         $_SESSION['stash'] = array();
         return $this->redirect("/");
    }
}
