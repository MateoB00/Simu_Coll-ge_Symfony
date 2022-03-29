<?php

namespace App\Controller;

use App\Entity\Eleve;
use App\Form\ProfType;
use App\Form\EleveType;
use App\Repository\EleveRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ElevesController extends AbstractController
{
    #[Route('/eleves', name: 'app_liste_eleves')]
    public function liste(EleveRepository $er): Response
    {

        $eleves = $er->findAll();

        return $this->render('eleves/index.html.twig', [
            'eleves' => $eleves,
        ]);
    }

    #[Route('/eleve/create', name: 'app_eleve_create')]
    public function create(Request $request, EleveRepository $er): Response
    {
        
        $eleve = new Eleve;

        $formulaire = $this->createForm(EleveType::class, $eleve);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $er->add($eleve);
            return $this->redirectToRoute('app_liste_eleves');
        } else {
            return $this->render('formulaires/formulaire.html.twig', [
                'form' => $formulaire->createView(),
                'name' => 'Eleve'
            ]);
        }

    }


    #[Route('/eleve/delete/{id}', name: 'app_eleve_delete')]
    public function delete($id, EleveRepository $er) {
        $eleve = $er->find($id);
        $er->remove($eleve);

        return $this->redirectToRoute('app_liste_eleves');
    }
}
