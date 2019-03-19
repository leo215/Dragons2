<?php
/**
 * Created by PhpStorm.
 * User: Dugrossy
 * Date: 11/02/2019
 * Time: 10:30
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route ("/")
     * @Route ("/accueil")
     */
    public function accueil()
    {
        return $this->render(
            '/accueil.html.twig'
        );
    }

    /**
     * @Route ("/article/{slug}")
     */
    public function read($slug)
    {


        return new Response("article: ".$slug);

    }


}