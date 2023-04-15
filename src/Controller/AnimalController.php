<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class AnimalController extends AbstractController
{

    public function index(AnimalRepository $animalRepository) : Response
    {
        //buscar no bd todos os animais cadastrados
        $data['animais'] = $animalRepository->findAll();
        $data['titulo'] = 'Gerenciar Animais';

        return $this->render('animal/index.html.twig', $data);
    }

    public function adicionar(Request $request, EntityManagerInterface $em) : Response
    {
        $msg = '';
        $animal = new Animal();
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            //Salvar o novo Animal no bd
            $em->persist($animal); //salvar na memoria
            $em->flush();
            $msg = "Animal cadastrado com sucesso!";
        }

        $data['titulo'] = 'Cadastrar novo animal';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderform('animal/form.html.twig', $data);
    }

    public function editar($id, Request $request, EntityManagerInterface $em, AnimalRepository $animalRepository) : Response
    {
        $msg = '';
        $animal = $animalRepository->find($id); //retorna animalpelo $id
        $form = $this->createForm(AnimalType::class, $animal);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid())
        {
            $em->flush(); //fazer update do animal no bd
            $msg ='Animal atualizado com sucesso';
        }

        $data['titulo'] = 'Editar animal';
        $data['form'] = $form;
        $data['msg'] = $msg;

        return $this->renderform('animal/form.html.twig', $data);
    }

        public function excluir($id, EntityManagerInterface $em, AnimalRepository $animalRepository) : Response
        {
            $animal = $animalRepository->find($id);
            $em->remove($animal); //excluir animal do bd
            $em->flush(); //excluir o animal do bd

            return $this->redirectToRoute('animal_index');
        }
    
    }