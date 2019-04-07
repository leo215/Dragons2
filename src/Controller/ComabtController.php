<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class ComabtController extends AbstractController
{
    /**
     * @Route("/comabt", name="comabt")
     *
     */
    public function index(Request $request)
    {
        //Si l'un des deux params est null, on renvoie sur la page recherche pour qu'un choix soit fait
        if (is_null($request->query->get('dragonNom')) || is_null($request->query->get('persNom'))) {
            return $this->redirectToRoute('recherche');
        }

        //On envoie toutes les données nécéssair au combat vers la vue
        return $this->render('comabt/index.html.twig', [
            'controller_name' => 'ComabtController',
            'dragonNom'       => $request->query->get('dragonNom'),
            'dragonVie'       => $request->query->get('dragonVie'),
            'dragonPuissance' => $request->query->get('dragonPuissance'),
            'dragonDefense'   => $request->query->get('dragonDefense'),
            'dragonDex'       => $request->query->get('dragonDex'),
            'dragonVitesse'   => $request->query->get('dragonVitesse'),
            'dragonImg'       => $request->query->get('dragonImg'),

            'persNom'       => $request->query->get('persNom'),
            'persVie'       => $request->query->get('persVie'),
            'persPuissance' => $request->query->get('persPuissance'),
            'persDefense'   => $request->query->get('persDefense'),
            'persDex'       => $request->query->get('persDex'),
            'persVitesse'   => $request->query->get('persVitesse'),
            'persImg'       => $request->query->get('persImg'),
        ]);


    }
}
