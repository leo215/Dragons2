<?php

namespace App\Controller;

use App\Entity\Dragon;
use App\Form\DragonType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DragonController extends AbstractController
{
    /**
     * @Route("/dragon", name="dragon")
     */
    public function index(Request $request, ObjectManager $manager)
    {
        $dragon =new Dragon();
        $form= $this->createForm(DragonType::class, $dragon);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $manager->persist($dragon);
            $manager->flush();

        }
        return $this->render('dragon/index.html.twig', [
            'controller_name' => 'DragonController',
            'form'=>$form->createView(),
        ]);
    }
}
