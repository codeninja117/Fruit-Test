<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Repository\FruitRepository;

#[Route(path: "/fruits", name: "fruits_")]
class FruitController extends AbstractController
{
    public function __construct(private FruitRepository $fruits)
    {
    }

    // #[Route('/fruit', name: 'app_fruit')]
    // public function index(): Response
    // {
    //     return $this->render('fruit/index.html.twig', [
    //         'controller_name' => 'FruitController',
    //     ]);
    // }

    #[Route(path: "", name: "all", methods: ["GET"])]
    function all(): Response
    {
        $data = $this->fruits->findAll();
        return $this->json($data);
    }
}
