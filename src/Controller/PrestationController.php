<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Form\PrestationType;
use App\Repository\PrestationRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/prestation")
 */
class PrestationController extends AbstractController
{
    /**
     * @Route("/", name="prestation_index", methods={"GET"})
     */
    public function index(PrestationRepository $prestationRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $donnees = $prestationRepository->findByStatut(785);
        $prestations = $paginator->paginate(
            $donnees,
            $request->query->getInt('page', 1),
            6
        );
        return $this->render('prestation/index.html.twig', [
            'prestations' => $prestations,
        ]);
    }

    /**
     * @Route("/new", name="prestation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $prestation = new Prestation();
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($prestation);
            $entityManager->flush();

            return $this->redirectToRoute('prestation_index');
        }

        return $this->render('prestation/new.html.twig', [
            'prestation' => $prestation,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="prestation_show", methods={"GET"})
     */
    public function show(Prestation $prestation): Response
    {
        return $this->render('prestation/show.html.twig', [
            'prestation' => $prestation,
        ]);
    }

    /**
     * @Route("/{id}/edit", name="prestation_edit", methods={"GET","POST"})
     */
    public function edit(Request $request, Prestation $prestation): Response
    {
        $form = $this->createForm(PrestationType::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('prestation_index');
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
        $session = new Session();
        $session->invalidate();
        return $this->redirectToRoute('prestation_index');
    }
}