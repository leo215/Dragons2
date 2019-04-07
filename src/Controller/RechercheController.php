<?php

namespace App\Controller;

use App\Entity\Dragon;
use App\Entity\Personnage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RechercheController extends AbstractController
{
    /**
     * @Route("/recherche", name="recherche")
     */
    public function index(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Dragon::class);
        $dragons    = $repository->findAll();

        $repository_2 = $this->getDoctrine()->getRepository(Personnage::class);
        $personnages  = $repository_2->findAll();

        $choices = [];
        $i       = 0;
        foreach ($dragons as $value) {
            $choices[$i + 1] = $value;
            $i++;
        }

        $dragon = new Dragon();
        $pers   = new Personnage();

        $builder = $this->createFormBuilder(array($dragon, $pers));
        $builder->add('id', entityType::class,
            [
                'class'        => Dragon::class,
                'choice_label' => 'nom',
                'multiple'     => false,
                'expanded'     => true,
            ]
        );
        $builder->add('nom', entityType::class,
            [
                'class'        => Personnage::class,
                'choice_label' => 'nom',
                'multiple'     => false,
                'expanded'     => true,
            ]
        );

        $builder->add('valider', SubmitType::class,
            [
                'label' => 'valider',
                'attr'  => ['class' => 'btn btn-primary btn-lg'],
            ]
        );
        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $dragon = $form->getData()['id'];
            $pers   = $form->getData()['nom'];
            dump($dragon);
            dump($pers);

            //on envoie les choix utilisateurs vers la page combat
            return $this->redirectToRoute('comabt',
                [
                    'dragonId'        => $dragon->getId(),
                    'dragonNom'       => $dragon->getNom(),
                    'dragonVie'       => $dragon->getVie(),
                    'dragonPuissance' => $dragon->getPuissance(),
                    'dragonDefense'   => $dragon->getDefense(),
                    'dragonDex'       => $dragon->getDex(),
                    'dragonVitesse'   => $dragon->getVitesse(),
                    'dragonImg'       => $dragon->getImg(),

                    'persId'        => $pers->getId(),
                    'persNom'       => $pers->getNom(),
                    'persVie'       => $pers->getVie(),
                    'persPuissance' => $pers->getPuissance(),
                    'persDefense'   => $pers->getDefense(),
                    'persDex'       => $pers->getDex(),
                    'persVitesse'   => $pers->getVitesse(),
                    'persImg'       => $pers->getImg(),
                ]);
        }


        return $this->render('recherche/index.html.twig', [
            'controller_name' => 'RechercheController',
            'dragons'         => $dragons,
            'personnages'     => $personnages,
            'form'            => $form->createView(), //creating my form
        ]);
    }
}
