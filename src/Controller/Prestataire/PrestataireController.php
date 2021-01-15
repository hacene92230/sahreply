<?php

namespace App\Controller\Prestataire;

use App\Entity\Prestation;
use App\Entity\Prestataire;
use App\Form\PrestationType;
use App\Repository\PrestationsRepository;
use App\Repository\PrestataireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PrestationStatutRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Knp\Snappy\Pdf;

/**
 * @Route("/prestataire")
 * @IsGranted("ROLE_PRESTATAIRE")
 */
class PrestataireController extends AbstractController
{
    /**
     * @Route("/prestation-disponible", name="prestataire_Prestationdisponible", methods={"GET"})
     */
    public function index(PrestationsRepository $prestationRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $prestationRepository->findByStatut(1);
        $prestation = $paginator->paginate($donnees, $request->query->getInt('page', 1), 10);
        return $this->render('prestataire/prestation/disponible.html.twig', [
            'prestations' => $prestation,
        ]);
    }

    /**
     * @Route("/prestations-a-realiser", name="prestataire_arealiser", methods={"GET"})
     */
    public function prestationArealiser(PrestataireRepository $prestataireRepo, Request $request): Response
    {
        $arealiser = $prestataireRepo->findByUser($this->getUser());
        return $this->render('prestataire/prestation/arealiser.html.twig', [
            'realisertbl' => $arealiser,
        ]);
    }

    /**
     * @Route("/consulter/{id}", name="prestataire_show", methods={"GET"})
     */
    public function show(Prestation $prestation): Response
    {
        return $this->render('prestataire/prestation/show.html.twig', ['prestation' => $prestation,]);
    }

    /**
     * @Route("-accepter-{id}", name="prestataire_accepter", methods={"GET"})
     */
    public function accepter(PrestationStatutRepository $statutRepo, PrestationsRepository $prestationRepo, REQUEST $request): Response
    {
        $prestataire = new Prestataires();
        $prestationRepo->findOneById($request->attributes->get('_route_params')['id'])->setStatut($statutRepo->findOneById(2));
        $prestataire->setUser($this->getUser())
        ->setPrestation($prestationRepo->findOneById($request->attributes->get('_route_params')["id"]))
        ->setAcceptAt(new \DateTime());
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($prestataire);
        $entityManager->flush();
        return $this->redirectToRoute('prestataire_arealiser');
    }

    /**
     * @Route("-create-pdf-{id}", name="prestataire_prestationPdfCreate", methods={"GET"})
     */
    public function pdfCreate()
    {
        $snappy = new Pdf('/usr/local/bin/wkhtmltopdf');
        $snappy->generateFromHtml('<h1>Bill</h1><p>You owe me money, dude.</p>', '/tmp/bill-123.pdf');
    }
}
