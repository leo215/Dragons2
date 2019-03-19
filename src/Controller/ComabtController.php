<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class ComabtController extends AbstractController
{
    /**
     * @Route("/comabt", name="comabt")
     */
    public function index()
    {
        return $this->render('comabt/index.html.twig', [
            'controller_name' => 'ComabtController',
        ]);
    }
}
