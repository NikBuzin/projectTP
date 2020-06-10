<?php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
        /**
        * @Route("/")
        */
    public function number()
    {
        $foods = $this->getDoctrine()->getRepository('App:Food')->findAll();
        for($i = 0; $i<count($foods); $i++)
        {
            if(!empty($foods[$i])){
                $foods[$i]->setImage(base64_encode(stream_get_contents($foods[0]->getImage())));
            }
            else continue;
        }
        dump($foods[0]->getImage());
        session_start();
        return $this->render('home.html.twig', [
            'foods' => $foods,
        ]);
    }
}