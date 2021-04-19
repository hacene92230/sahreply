<?php

namespace App\Controller\Admin;

use App\Entity\User;
use App\Form\UserTypes;
use App\Repository\UserRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin")
 */
class AdminUserController extends AbstractController
{
    public function __construct(UserRepository $user)
    {
        $this->user = $user;
    }

    /**
     * @Route("/admin/users", name="admin_users_index")
     */
    public function userIndex(Request $request, PaginatorInterface $paginator): Response
    {
        $user = $paginator->paginate($this->user->findAll(), $request->query->getInt('page', 1), 10);
        return $this->render('admin/users/index.html.twig', [
            'users' => $user,
        ]);
    }


    /**
     * @Route("/delete/{id}", name="admin_users_delete", methods={"GET"})
     */
    public function userDelete(Request $request, User $user): Response
    {
        $entityManager = $this->getDoctrine()->getManager();
        $entityManager->remove($user);
        $entityManager->flush();
        return $this->redirectToRoute('home');
    }

    /**
     * @Route("/show/{id}", name="admin_users_show", methods={"GET"})
     */
    public function userShow(User $user): Response
    {
        return $this->render('admin/users/show.html.twig', [
            'user' => $user
        ]);
    }

    /**
     * @Route("/editer/{id}/edit", name="admin_users_edit", methods={"GET","POST"})
     */
    public function userEdit(UserPasswordEncoderInterface $encoder, Request $request, User $user): Response
    {
        $form = $this->createForm(UserTypes::class, $user);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            //Permet de hashé le mot de passe
            $mdp = $encoder->encodePassword($user, $form->get('plainPassword')->getData());
            //Envoi le mot de passe hashé                
            $user->setPassword($mdp);
            $this->getDoctrine()->getManager()->flush();
            return $this->redirectToRoute('home');
        }
        return $this->render('admin/users/edit.html.twig', [
            'user' => $user,
            'form' => $form->createView(),
        ]);
    }
}
