<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Entity\ConsumoRacao;
use App\Form\AnimalType;
use App\Form\ConsumoRacaoType;
use App\Repository\AnimalRepository;
use App\Repository\ConsumoRacaoRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class ConsumoRacaoController extends AbstractController
{

    public function index(ConsumoRacaoRepository $consumoRacaoRepository) : Response
    {
        //buscar no bd todos os animais cadastrados
        $data['consumos'] = $consumoRacaoRepository->findAll();
        $data['titulo'] = 'Gerenciar Consumo de Ração';

        return $this->render('ConsumoRacao/index.html.twig', $data);
    }

    public function adicionar(Request $request, EntityManagerInterface $em) : Response
    {
        $msg = '';
        $consumoRacao = new ConsumoRacao();
        $form = $this->createForm(ConsumoRacaoType::class, $consumoRacao);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //Salvar o novo Animal no bd
            $em->persist($consumoRacao); //salvar na memoria
            $em->flush();
            $msg = "cadastrado com sucesso!";
        }

        $data['titulo'] = 'Consumo de Ração';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderform('ConsumoRacao/form.html.twig', $data);
    }

    public function editar($id, Request $request, EntityManagerInterface $em, ConsumoRacaoRepository $consumoRacaoRepository) : Response
    {
        $msg = '';
        $consumoRacao = $consumoRacaoRepository->find($id);
        $form = $this->createForm(ConsumoRacaoType::class, $consumoRacao);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //Atualizar o novo Animal no bd
            $em->flush();
            $msg = "atualizado com sucesso!";
        }

        $data['titulo'] = 'Editar Consumo de Ração';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderform('ConsumoRacao/form.html.twig', $data);
    }

    public function excluir($id, EntityManagerInterface $em, ConsumoRacaoRepository $consumoRacaoRepository) : Response
    {
        $consumoRacao = $consumoRacaoRepository->find($id);
        $em->remove($consumoRacao);
        $em->flush();

        //redireciona para consumoRacao index
        return $this->redirectToRoute('consumo_racao_index');
    }
}