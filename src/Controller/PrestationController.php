<?php

namespace App\Controller;

use App\Entity\Prestation;
use App\Form\PrestationTypes;
use App\Repository\PrestationRepository;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PrestationStatutRepository;
use DateTime;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/prestation")
 * @IsGranted("ROLE_CLIENT")
 */
class PrestationController extends AbstractController
{
    public function __construct(PrestationRepository $prestation, PrestationStatutRepository $Prestationtatut)
    {
        $this->prestation = $prestation;
        $this->Prestationtatut = $Prestationtatut;
    }

    /**
     * @Route("/fin", name="prestation_fin", methods={"GET"})
     * @Route("/cours", name="prestation_cours", methods={"GET"})
     * @Route("/attente", name="prestation_attente", methods={"GET"})
     */
    public function index(): Response
    {
        return $this->render('prestation/index.html.twig', [
            'prestations' => $this->prestation->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="prestation_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $prestation = new Prestation();
        $prestation->setEndat(new DateTime());
        $form = $this->createForm(PrestationTypes::class, $prestation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $prestation->setStatut($this->Prestationtatut->findOneById(1));
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
     * @Route("/consulter/{id}", name="prestation_show", methods={"GET"})
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
        $form = $this->createForm(PrestationTypes::class, $prestation);
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
