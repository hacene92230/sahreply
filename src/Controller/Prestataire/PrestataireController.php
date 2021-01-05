<?php

namespace App\Controller\Prestataire;

use App\Entity\Prestation;
use App\Form\PrestationFormType;
use App\Repository\PrestationRepository;
use App\Repository\PrestationStatutRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/prestataire")
 */
class PrestataireController extends AbstractController
{
    /**
     * @Route("/prestation-disponible", name="prestataire_Prestationdisponible", methods={"GET"})
     */
    public function index(PrestationRepository $prestationRepository, Request $request): Response
    {
        return $this->render('prestataire/prestation/index.html.twig', [
            'prestations' => $prestationRepository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="prestation_new", methods={"GET","POST"})
     */
    public function new(Request $request, PrestationStatutRepository $prestationRepo): Response
    {
        $prestation = new Prestation();
        $form = $this->createForm(PrestationFormType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prestation->setStatut($prestationRepo->findOneByNom("en attente d'acceptation"));
            $prestation->setUser($this->getUser());
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prestation);
            $entityManager->flush();
            return $this->redirectToRoute('prestation_attente');
        }

        return $this->render('prestation/new.html.twig', [
            'prestation' => $prestation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prestataire_show", methods={"GET"})
     */
    public function show(Prestation $prestation): Response
    {
        return $this->render('prestataire/prestation/show.html.twig', [
            'prestation' => $prestation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prestation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Prestation $prestation): Response
    {
        $form = $this->createForm(PrestationFormType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prestation_attente');
        }

        return $this->render('prestation/edit.html.twig', [
            'prestation' => $prestation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prestation_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Prestation $prestation): Response
    {
        if ($this->isCsrfTokenValid('delete' . $prestation->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($prestation);
            $entityManager->flush();
        }
        return $this->redirectToRoute('prestation_attente');
    }
}
