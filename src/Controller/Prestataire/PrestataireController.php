<?php

namespace App\Controller\Prestataire;

use App\Wkhtml\PDFRender;
use App\Entity\Prestation;
use App\Entity\Prestataire;
use App\Form\PrestationFormType;
use App\Repository\PrestationRepository;
use App\Repository\PrestataireRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Repository\PrestationStatutRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/prestataire")
* @IsGranted("ROLE_PRESTATAIRE")
 */
class PrestataireController extends AbstractController
{
    /**
     * @Route("/prestation-disponible", name="prestataire_Prestationdisponible", methods={"GET"})
     */
    public function index(PrestationRepository $prestationRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $donnees = $prestationRepository->findByStatut(1);
        $prestation = $paginator->paginate($donnees, $request->query->getInt('page', 1), 10);
        return $this->render('prestataire/prestation/disponible.html.twig', [
            'prestations' => $prestation,
        ]);
    }

    /**
     * @Route("/mes-prestations-futures", name="prestataire_futur", methods={"GET"})
     */
    public function prestationFutur(PrestataireRepository $prestataireRepo, Request $request): Response
    {
        $futur = $prestataireRepo->findByUser($this->getUser());
        return $this->render('prestataire/prestation/futur.html.twig', [
            'futures' => $futur,
        ]);
    }

    /**
     * @Route("/consulter/{id}", name="prestataire_show", methods={"GET"})
     */
    public function show(PRESTATION $prestation): Response
    {
        return $this->render('prestataire/prestation/show.html.twig', ['prestation' => $prestation,]);
    }

    /**
     * @Route("-accepter-{id}", name="prestation_accepter", methods={"GET"})
     */
    public function accepter(PrestationStatutRepository $statutRepo, PrestationRepository $prestationRepo, REQUEST $request): Response
    {
        $prestataire = new Prestataire();
        $prestationRepo->findOneById($request->attributes->get('_route_params'))->setStatut($statutRepo->findOneById(2));
        $prestataire->setUser($this->getUser());
        $prestataire->setPrestation($prestationRepo->findOneById($request->attributes->get('_route_params')));
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->persist($prestataire);
        $entityManager->flush();
        return $this->redirectToRoute('prestataire_futur');
    }
}
