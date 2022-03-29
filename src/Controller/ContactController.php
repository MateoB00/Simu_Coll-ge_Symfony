<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Component\Mime\Email;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response {

        $formulaire = $this->createForm(ContactType::class);
        $formulaire->handleRequest($request);

        if ($formulaire->isSubmitted() && $formulaire->isValid()) {
            $data = $formulaire->getData();

            $email = new Email();
            $email->from('ContactForm <' . $data['email'] . '>')
                ->to('tpsymfony.91@gmail.com')
                ->subject($data['sujet'])
                ->text($data['message']);

            $mailer->send($email);

            return $this->redirectToRoute('app_contact');
        } else {
            return $this->render('formulaires/formulaire.html.twig', [
                'form' => $formulaire->createView(),
                'name' => 'mail'
            ]);
        }
    }
}
