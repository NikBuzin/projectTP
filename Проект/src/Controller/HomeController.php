<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
        /**
         * Show home page
        * @Route("/")
        */
    public function show()
    {
        $foods = $this->getDoctrine()->getRepository('App:Food')->findAll();
        session_start();
        return $this->render('home.html.twig', [
            'foods' => $foods,
        ]);
    }
    /**
     * Show home page with filter
     * @Route("/filter")
     */
    public function showFilter()
    {
        $foods = $this->getDoctrine()->getRepository('App:Food')->findBy(array('type'=>$_GET['type']));
        session_start();
        return $this->render('home.html.twig', [
            'foods' => $foods,
        ]);
    }
}