<?php

namespace App\Controller;

use App\Entity\Note;
use App\Form\NoteType;
use App\Repository\NoteRepository;
use App\Repository\EleveRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NoteController extends AbstractController
{
    #[Route('/note/create/{id}', name: 'app_note_create')]
    public function index(Request $request, NoteRepository $nr, $id, EleveRepository $er): Response
    {

        $note = new Note;
        $eleve = $er->find($id);
        $formulaire = $this->createForm(NoteType::class, $note);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {

            $note->setEleve($eleve);
            $nr->add($note);
            return $this->redirectToRoute('app_liste_eleves');
        } else {
            return $this->render('formulaires/formulaire.html.twig', [
                'form' => $formulaire->createView(),
                'name' => 'Note'
            ]);
        }

    }
}
