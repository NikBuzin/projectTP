<?php
namespace App\Controller;

use Symfony\Component\BrowserKit\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class EditFoodListController extends AbstractController
{
    /**
     * Show edit page
     * @Route("/editFoodList")
     */
    public function show(){
        $food=$this->getDoctrine()->getRepository('App:Food')->find($_GET['id']);
        return $this->render('editFoodList.html.twig', [
            'food' => $food,
        ]);
    }
    /**
     * Update food information
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
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fi = finfo_open(FILEINFO_MIME_TYPE);
        $mime = (string) finfo_file($fi, $fileTmpName);
        if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');
        $image = getimagesize($fileTmpName);
        $path = $fileTmpName ? $fileTmpName . '/' : '';
        do {
            $name = md5(microtime() . rand(0, 9999));
            $file = $path . $name;
        } while (file_exists($file));
        $extension = image_type_to_extension($image[2]);
        $format = str_replace('jpeg', 'jpg', $extension);
        if (!move_uploaded_file($fileTmpName, 'C:\xampp\php\www\projectTP\Проект\public\base\img\dishes/' . $name . $format)) {
            die('При записи изображения на диск произошла ошибка.');
        }
        $food->setImage($name);
        $entityManager->flush();
        return $this->redirect('/foodList');
    }

    /**
     * Food information remove
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
