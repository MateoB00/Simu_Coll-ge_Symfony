<?php

namespace App\Controller;

use App\Repository\EleveRepository;
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
}
