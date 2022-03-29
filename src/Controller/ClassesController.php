<?php

namespace App\Controller;

use App\Entity\Classe;
use App\Form\ClassesType;
use App\Repository\ClasseRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ClassesController extends AbstractController
{
    #[Route('/classes', name: 'app_liste_classes')]
    public function index(ClasseRepository $cr): Response
    {

        $classes = $cr->findAll();

        return $this->render('classes/index.html.twig', [
            'classes' => $classes,
        ]);
    }


    #[Route('/classe/create', name: 'app_classe_create')]
    public function create(Request $request, ClasseRepository $cr): Response
    {
        
        $classe = new Classe;

        $formulaire = $this->createForm(ClassesType::class, $classe);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $cr->add($classe);
            return $this->redirectToRoute('app_liste_classes');
        } else {
            return $this->render('formulaires/formulaire.html.twig', [
                'form' => $formulaire->createView(),
                'name' => 'Classe'
            ]);
        }

    }
}
