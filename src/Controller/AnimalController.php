<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;


class AnimalController extends AbstractController
{

    public function index(EntityManagerInterface $em) : Response
    {
        $animal = new Animal();
        $animal -> setQntdLeite(123);
        $animal -> setPeso(123);
        $animal -> setQntdRacao(123);
        $animal -> setDtNasc(new DateTimeImmutable('2020-01-01'));
        
        
    try{
        $em -> persist($animal);
        $em -> flush();
        $msg = "Animal cadastrado com sucesso";
    }

    catch(Exception $e){
        $msg = "Erro ao cadastrar animal";
        }
        return new Response("<h1>" . $msg . "</h1>");
    }

    public function adicionar() : Response
    {
        $form = $this->createForm(AnimalType::class);
        $data['titulo'] = 'Cadastrar novo animal';
        $data['form'] = $form;

        return $this->renderform('animal/form.html.twig', $data);
    }
}