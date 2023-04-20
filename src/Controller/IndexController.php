<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class IndexController extends AbstractController
{

    #[Route('/', name: 'home')]
    public function index(AnimalRepository $animalRepository) : Response
    {

        //restringir a pagina apenas aos ROLE_USER
        $this->denyAccessunlessGranted('ROLE_USER');
        $data['titulo'] = 'Gestão de Fazenda';
        $data['qtdleite'] = $animalRepository->findBySunLeite();
        $data['qtdracao'] = $animalRepository->findBySUMRacao();
        $data['boinovo'] = $animalRepository->findByIdade();
        return $this->render('home/index.html.twig', $data);
    }
}