<?php

namespace App\Controller;

use App\Form\ProfType;
use App\Entity\Matiere;
use App\Form\MatiereType;
use App\Repository\MatiereRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatiereController extends AbstractController
{
    #[Route('/matiere', name: 'app_liste_matiere')]
    public function liste(MatiereRepository $mr): Response
    {

        $matieres = $mr->findall();

        return $this->render('matiere/index.html.twig', [
            'matieres' => $matieres,
        ]);
    }

    #[Route('/matiere/create', name: 'app_matiere_create')]
    public function create(Request $request, MatiereRepository $pr): Response
    {
        
        $matiere = new Matiere;

        $formulaire = $this->createForm(MatiereType::class, $matiere);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $pr->add($matiere);
            return $this->redirectToRoute('app_liste_matiere');
        } else {
            return $this->render('formulaires/formulaire.html.twig', [
                'form' => $formulaire->createView(),
                'name' => 'Matière'
            ]);
        }

    }
}
