<?php

namespace App\Controller;

use App\Entity\Users;
use App\Form\UserType;
use App\Form\RegistrationType;
use App\Repository\UsersRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/user")
 */
class UserController extends AbstractController
{

    /**
     * @Route("/account/{id}", name="user_info", methods={"GET"})
     */
    public function userShow(Users $user): Response
    {
        if ($this->getUser() === $user) {
            return $this->render('user/show.html.twig', [
                'user' => $user,
            ]);
        } else {
            return $this->render('user/erreur.html.twig', [
                'user' => $user,
            ]);
        }
    }

    /**
     * @Route("/{id}/edit", name="user_edit", methods={"GET","POST"})
     */
    public function userEdit(UserPasswordEncoderInterface $encoder, Request $request, UserS $user): Response
    {
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);
        if ($this->getUser() == $user) {
            if ($form->isSubmitted() && $form->isValid()) {
                //Permet de crypter le mot de passe
                $mdp = $encoder->encodePassword($user, $form->get('plainPassword')->getData());
                //Envoi le mot de passe hashé                
                $user->setPassword($mdp);
                $this->getDoctrine()->getManager()->flush();
                return $this->redirectToRoute('home');
            }

            return $this->render('user/edit.html.twig', [
                'user' => $user,
                'form' => $form->createView(),
            ]);
        } else {
            return $this->render('user/erreur.html.twig', [
                'user' => $user,
            ]);
        }
    }

    /**
     * @Route("/{id}", name="user_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Users $user): Response
    {
        if ($this->isCsrfTokenValid('delete' . $user->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($user);
            $entityManager->flush();
        }
        return $this->redirectToRoute('app_logout');
    }
}
