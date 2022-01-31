<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('/', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    #[Route('/about/{name?}', name: 'about')]
    public function main(Request $request): Response
    {

        $name = $request->get('name');
        if($name != null){
            return $this->render('devs/about.html.twig', ['name' => $request->get('name')]);
        }
        else {
            return $this->render('about/default.html.twig');
        }
    }
}
