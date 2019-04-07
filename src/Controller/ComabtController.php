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
            'personnagenom'=>"bezz",
            'personnagevie'=>23,
            'personnagepuissance'=>46,
            'personnagedefense'=>767,
            'personnagevitesse'=>556,
            'personnagedex'=>6567,

             'dragonnom'=>"bezz",
            'dragonvie'=>23,
            'dragonpuissance'=>46,
            'dragondefense'=>767,
            'dragonvitesse'=>556,
            'dragondex'=>6567
        ]);
    }
}
