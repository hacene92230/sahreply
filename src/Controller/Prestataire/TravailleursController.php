<?php

namespace App\Controller\Prestataire;

use App\Entity\Demande;
use App\Form\DemandeTypes;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/travailleurs")
 */
class TravailleursController extends AbstractController
{
    /**
     * @Route("/postuler", name="travailleurs_postuler")
     */
    public function postuler(Request $request): Response
    {
        $travailleur = new Demande();
        $form = $this->createForm(DemandeTypes::class, $travailleur);
        if ($form->isSubmitted() && $form->isValid()) {
        }

        return $this->render('travailleurs/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
