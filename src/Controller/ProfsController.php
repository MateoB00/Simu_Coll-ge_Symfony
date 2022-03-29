<?php

namespace App\Controller;

use App\Entity\Prof;
use App\Form\ProfType;
use App\Repository\ProfRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProfsController extends AbstractController
{
    #[Route('/profs', name: 'app_liste_profs')]
    public function liste(ProfRepository $pr): Response
    {

        $profs = $pr->findall();

        return $this->render('profs/liste.html.twig', [
            'profs' => $profs,
        ]);
    }


    #[Route('/prof/create', name: 'app_prof_create')]
    public function create(Request $request, ProfRepository $pr): Response
    {
        
        $prof = new Prof;

        $formulaire = $this->createForm(ProfType::class, $prof);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $pr->add($prof);
            return $this->redirectToRoute('app_liste_profs');
        } else {
            return $this->render('formulaires/formulaire.html.twig', [
                'form' => $formulaire->createView(),
                'name' => 'Prof'
            ]);
        }

    }
}
