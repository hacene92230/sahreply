<?php

namespace App\Controller\Travailleurs;

use App\Repository\DemandeRepository;
use App\Entity\Demande;
use App\Form\DemandeTypes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/travailleurs")
 * @IsGranted("ROLE_CLIENT")
 */
class TravailleursController extends AbstractController
{
    /**
     * @Route("/postuler", name="travailleurs_postuler")
     */
    public function postuler(DemandeRepository $demandeRepo, Request $request): Response
    {
        if (!empty($demandeRepo->findOneByUser($this->getUser()))) {
            $this->addFlash('success', 'Une demande nous à déjà été transmise, veuillez patienter durant son traitement.');
            return $this->redirectToRoute('home');
        }
        $travailleur = new Demande();
        $form = $this->createForm(DemandeTypes::class, $travailleur);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $travailleur->setUser($this->getUser());
            $travailleur->setStatut(false);
            $this->addFlash('success', 'votre demande nous à bien été transmise, nous reviendrons très vite vers vous.');
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($travailleur);
            $entityManager->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('travailleurs/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
