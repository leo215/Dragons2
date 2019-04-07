<?php

namespace App\Controller;

use App\Entity\Dragon;
use App\Entity\Personnage;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Task;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class RechercheController extends AbstractController
{
    /**
     * @Route("/recherche", name="recherche")
     */
    public function index(Request $request)
    {
        $repository = $this->getDoctrine()->getRepository(Dragon::class);
        $dragons = $repository->findAll();

        $repository_2 = $this->getDoctrine()->getRepository(Personnage::class);
        $personnages = $repository_2->findAll();

        $choices = [];
        $i=0;
        foreach($dragons as $value)
        {
            $choices[$i+1] = $value;
            $i++;
        }

        $dragon = new Dragon();
        $pers = new Personnage();

        $builder = $this->createFormBuilder(array($dragon,$pers));
        $builder->add('id',entityType::class,
            [
            'class' => Dragon::class,
            'choice_label' => 'nom',
            'multiple' => false,
            'expanded' => true,
            ]
        );
        $builder->add('nom',entityType::class,
            [
                'class' => Personnage::class,
                'choice_label' => 'nom',
                'multiple' => false,
                'expanded' => true,
            ]
        );

        $builder->add('valider',SubmitType::class,
            [
                'label' => 'valider',
                'attr' => ['class' => 'btn btn-primary btn-lg'],
            ]
        );
        $form = $builder->getForm();

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // $form->getData() holds the submitted values
            // but, the original `$task` variable has also been updated
            $dragon = $form->getData()[0];
            $pers = $form->getData()[1];

            // ... perform some action, such as saving the task to the database
            // for example, if Task is a Doctrine entity, save it!
            // $entityManager = $this->getDoctrine()->getManager();
            // $entityManager->persist($task);
            // $entityManager->flush();

            //on envoie les choix utilisateurs vers la page combat
            return $this->redirectToRoute('comabt', array($dragon,$pers));
        }


        return $this->render('recherche/index.html.twig', [
            'controller_name' => 'RechercheController',
            'dragons' => $dragons,
            'personnages' => $personnages,
            'form' => $form->createView(), //creating my form
        ]);
    }
}
