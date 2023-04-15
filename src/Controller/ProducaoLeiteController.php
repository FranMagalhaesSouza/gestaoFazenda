<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\ConsumoRacao;
use App\Entity\ProducaoLeite;
use App\Form\AnimalType;
use App\Form\ConsumoRacaoType;
use App\Form\ProducaoLeiteType;
use App\Repository\AnimalRepository;
use App\Repository\ConsumoRacaoRepository;
use App\Repository\ProducaoLeiteRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ProducaoLeiteController extends AbstractController
{

    public function index(ProducaoLeiteRepository $producaoLeiteRepository) : Response
    {
        //buscar no bd todos os animais cadastrados
        $data['producoes'] = $producaoLeiteRepository->findAll();
        $data['titulo'] = 'Gerenciar Produção de Leite';

        return $this->render('ProducaoLeite/index.html.twig', $data);
    }

    public function adicionar(Request $request, EntityManagerInterface $em) : Response
    {
        $msg = '';
        $producaoLeite = new ProducaoLeite();
        $form = $this->createForm(ProducaoLeiteType::class, $producaoLeite);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //Salvar o novo Animal no bd
            $em->persist($producaoLeite); //salvar na memoria
            $em->flush();
            $msg = "cadastrado com sucesso!";
        }

        $data['titulo'] = 'Produção de Leite';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderform('ProducaoLeite/form.html.twig', $data);
    }
}