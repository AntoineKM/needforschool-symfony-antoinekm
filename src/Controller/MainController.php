<?php

namespace App\Controller;

use App\Entity\City;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{

    #[Route('/city/{id}', name: 'city')]
    public function city(City $city): Response
    {
        return $this->render('main/city.html.twig', [
            'city' => $city,
        ]);
    }

    #[Route('/', name: 'home')]
    public function home(RestaurantRepository $restaurantRepository): Response
    {
        $restaurants = $restaurantRepository->findAll();

        return $this->render('main/index.html.twig', [
            'restaurants' => $restaurants,
        ]);
    }
}
