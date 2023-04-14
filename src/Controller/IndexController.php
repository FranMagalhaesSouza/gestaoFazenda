<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;

class IndexController extends AbstractController
{
    public function index() : Response
    {
        $data['titulo'] = 'Gestão de Fazenda';
        $data['mensagem'] = 'ok';
        $data['animais'] = [
           
            [
                'nome' => 'gado1',
                'peso' => 1.000
            ],

            [
                'nome' => 'gado2',
                'peso' => 900
            ],
            [
                'nome' => 'gado3',
                'peso' => 1.200
            ],
            
            [
                'nome' => 'gado4',
                'peso' => 1.400
            ]  
        ];

        return $this->render('index/index.html.twig', $data);
    }
}