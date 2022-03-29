<?php

namespace App\Controller;

use App\Repository\ClasseRepository;
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
}
