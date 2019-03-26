<?php

namespace App\Controller;

use App\Entity\Dragon;
use App\Entity\Personnage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class RechercheController extends AbstractController
{
    /**
     * @Route("/recherche", name="recherche")
     */
    public function index()
    {
        $repository = $this->getDoctrine()->getRepository(Dragon::class);
        $dragons = $repository->findAll();

        $repository_2 = $this->getDoctrine()->getRepository(Personnage::class);
        $personnages = $repository_2->findAll();

        return $this->render('recherche/index.html.twig', [
            'controller_name' => 'RechercheController',
            'dragons' => $dragons,
            'personnages' => $personnages,
        ]);
    }
}
