<?php

namespace App\Controller;

use App\Entity\Personnage;
use App\Form\PersonnageType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class PersonnageController extends AbstractController
{
    /**
     * @Route("/personnage", name="personnage")
     */
    public function index(Request $request, ObjectManager $manager)
    {
        $personnage= new Personnage();
        $form= $this->createForm(PersonnageType::class, $personnage);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isSubmitted()){
            $manager->persist($personnage);
            $manager->flush();

        }
        return $this->render('personnage/index.html.twig', [
            'controller_name' => 'PersonnageController',
            'form'=>$form->createView(),
        ]);
    }
}
