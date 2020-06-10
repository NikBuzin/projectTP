<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ActiveOrdersController extends AbstractController
{
    /**
     * Show list active orders
     * @Route("/activeOrders")
     */
    public function show()
    {
        $orders = $this->getDoctrine()->getRepository('App:Order')->findAll();
        $couriers = $this->getDoctrine()->getRepository('App:Courier')->findAll();
        return $this->render('activeOrders.html.twig', [
            'orders' => $orders,
            'couriers' => $couriers,
        ]);
    }
    /**
     * Set courier order
     * @Route("/orderToCourier")
     */
    public function addOrderToCourier(){
        $entityManager = $this->getDoctrine()->getManager();
        $order = $this->getDoctrine()->getRepository("App:Order")->find($_GET['order_id']);
        $order->setCourierId($_GET['courier_id']);
        $order->setStatus('In progress');
        $entityManager->persist($order);
        $entityManager->flush();
        return $this->redirect('/activeOrders');
    }
    /**
     * Finish Order
     * @Route("/finishOrder")
     */
    public function finishOrder(){
        $entityManager = $this->getDoctrine()->getManager();
        $order = $this->getDoctrine()->getRepository("App:Order")->find($_GET['order_id']);
        $order->setStatus('Finish');
        $entityManager->persist($order);
        $entityManager->flush();
        $orders = $this->getDoctrine()->getRepository("App:Order")->findBy(array('courier_id'=>$_GET['courier_id']));
        return $this->render('courier.html.twig', [
            'courier' => $courier = $this->getDoctrine()->getRepository('App:Courier')->find($_GET['courier_id']),
            'orders' => $orders,
        ]);
    }
}