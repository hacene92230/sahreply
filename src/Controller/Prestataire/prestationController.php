<?php

namespace App\Controller\Prestataire;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class prestationController extends AbstractController
{
    /**
     * @Route("/prestataire/prestation", name="prestataire_prestation")
     */
    public function index(): Response
    {
        return $this->render('prestataire/prestation/index.html.twig', [
            'controller_name' => 'prestationController',
        ]);
    }
}
