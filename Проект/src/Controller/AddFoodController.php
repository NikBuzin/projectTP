<?php

namespace App\Controller;
use App\Entity\Food;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AddFoodController extends AbstractController
{
    /**
     * @Route("/addFood")
     */
    public function number()
    {
        $entityManager = $this->getDoctrine()->getManager();
        $food = new Food();
        $food->setName($_REQUEST['title']);
        $food->setDescription($_REQUEST['description']);
        $food->setPrice($_REQUEST['price']);
        $fileTmpName = $_FILES['image']['tmp_name'];
        $fi = finfo_open(FILEINFO_MIME_TYPE);
        $mime = (string) finfo_file($fi, $fileTmpName);
        if (strpos($mime, 'image') === false) die('Можно загружать только изображения.');

        // Результат функции запишем в переменную
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
        $entityManager->persist($food);
        $entityManager->flush();
        return $this->redirect("/foodList");
    }

}