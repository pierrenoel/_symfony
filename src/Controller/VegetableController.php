<?php

namespace App\Controller;

use App\Entity\Vegetable;
use App\Form\VegetableType;
use App\Repository\VegetableRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class VegetableController extends AbstractController
{

    #[Route('/vegetable', name: 'vegetable_index')]
    public function index(VegetableRepository $vegetableRepository): Response
    {
        return $this->render('vegetable/index.html.twig', [
            'vegetables' => $vegetableRepository->findAll()
        ]);
    }

    #[Route('vegetable/add',name:'vegetable_add')]
    public function add(Request $request, VegetableRepository $vegetableRepository) : Response
    {
        $vegatable = new Vegetable();

        $form = $this->createForm(VegetableType::class,$vegatable);

        $form->handleRequest($request);

        if($form->isValid() && $form->isSubmitted())
        {
            $vegetableRepository->save($vegatable,true);

            return $this->redirectToRoute('vegetable_index');
        }

        return $this->render('vegetable/add.html.twig',[
            'form' => $form
        ]);
    }
}
