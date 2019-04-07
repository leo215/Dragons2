<?php

namespace App\Controller;

use App\Entity\Admin;
use App\Form\RegistrationType;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AdminController extends AbstractController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }


    /**
     * @Route("/enregistre", name="enregistre")
     */
    public function enregistrepage(){
        return $this->render('admin/enregistre.html.twig');
    }


    /**
     * @Route("/enregistre", name="enregistre")
     */
    public function enregistre( Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder){


        $admin =new Admin();

        $form= $this->createForm(RegistrationType::class, $admin);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $hash= $encoder->encodePassword($admin, $admin->getPassword());
            $admin->setPassword($hash);
            $manager->persist($admin);
            $manager->flush();

            return $this->redirectToRoute('ajout');

        }

        return $this->render('admin/enregistre.html.twig ',[
            'form'=>$form->createView()
        ]);

    }

    /**
     * @Route("/ajout", name="ajout")
     */
    public function ajout(){
        return $this->render('admin/ajout.html.twig');
    }


    /**
     * @Route("/connexion", name="connexion")
     */
    public function connexion(){
        return $this->render('admin/connexion.html.twig');
    }


}
