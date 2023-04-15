<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    public function index() : Response
    {
        $data['titulo'] = 'Gestão de Fazenda';
        return $this->render('index/index.html.twig', $data);
    }
}