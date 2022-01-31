<?php

namespace App\Controller;


use App\Entity\User;
use App\Form\CreateUserType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class RegisterController extends AbstractController
{
    #[Route('/register', name: 'register')]
    public function register(ManagerRegistry $doctrine,Request $request, UserPasswordHasherInterface  $passwordEncoder): Response
    {
        //Create new Dev
        $user = new User();

        $form = $this->createForm(CreateUserType::class,$user);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            $data = $form->getData();
            $user -> setUsername($data['username']);
            $user -> setPassword(
                $passwordEncoder->hashPassword($user,$data['password'])
            );
            $user -> setRoles(['ROLE_USER']);

            // Entity Manager
            $em = $doctrine->getManager();
            dump($user);
            $em->persist($user);
            $em->flush();

            return $this->redirect($this->generateUrl('home'));
        }
        // return Response

        return $this->render('register/index.html.twig', ['form' => $form->createView()]);
    }
}
