<?php

namespace App\Controller;

use App\Entity\Devs;
use App\Form\CreateDevType;
use App\Repository\DevsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Persistence\ManagerRegistry;

#[Route('/devs', name: 'devs.')]
class DevsController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(DevsRepository $devsRepository): Response
    {
        $devs = $devsRepository->findAll();

        return $this->render('devs/index.html.twig',[ 'devs' => $devs ]);
    }
    #[Route('/post', name: 'post')]
    public function create(ManagerRegistry $doctrine,Request $request): Response
    {
        //Create new Dev
        $dev = new Devs();

        $form = $this->createForm(CreateDevType::class,$dev);

        $form->handleRequest($request);

        if($form->isSubmitted()){
            // Entity Manager
            $em = $doctrine->getManager();

            $em->persist($dev);
            $em->flush();

            $this->addFlash('success', 'Developer was created');

            return $this->redirect($this->generateUrl('devs.index'));
        }
        // return Response

        return $this->render('devs/createForm.html.twig', ['form' => $form->createView()]);
    }

    #[Route('/show/{id}', name: 'getDev')]
    public function showDev(DevsRepository $devsRepository,Request $request): Response
    {
        $id = $request->get('id');
        $dev = $devsRepository->find($id);
        return $this->render('devs/about.html.twig',[ 'dev' => $dev ]);
    }

    #[Route('/remove/{id}', name: 'deleteDev')]
    public function deleteDev(DevsRepository $devsRepository,Request $request,ManagerRegistry $doctrine,): Response
    {
        $id = $request->get('id');
        $dev = $devsRepository->find($id);

        $em = $doctrine->getManager();

        $em->remove($dev);
        $em->flush();

        $this->addFlash('success', 'Developer was removed');

        return $this->redirect($this->generateUrl('devs.index'));
    }
}
