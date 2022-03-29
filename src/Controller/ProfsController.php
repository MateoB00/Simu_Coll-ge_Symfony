<?php

namespace App\Controller;

use App\Repository\ProfRepository;
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
}
