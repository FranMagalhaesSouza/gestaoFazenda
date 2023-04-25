<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class IndexController extends AbstractController
{
    #[IsGranted('ROLE_USER')]
    #[Route('/', name: 'home')]
    public function index(AnimalRepository $animalRepository) : Response
    {
        $data['titulo'] = 'Gestão de Fazenda';
        $data['qtdleite'] = $animalRepository->findBySunLeite();
        $data['qtdracao'] = $animalRepository->findBySUMRacao();
        $data['boinovo'] = $animalRepository->findByIdade();
        return $this->render('home/index.html.twig', $data);
    }
}