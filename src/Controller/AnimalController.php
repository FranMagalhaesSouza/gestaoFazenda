<?php

namespace App\Controller;

use App\Entity\Animal;
use App\Form\AnimalType;
use App\Repository\AnimalRepository;
use App\Service\MessageGenerator;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
class AnimalController extends AbstractController
{

    #[isGranted('ROLE_USER')]
    #[Route('/animal', name: 'animal_index')]
    public function index(Request $request, AnimalRepository $animalRepository, PaginatorInterface $paginator): Response
    {
        try {
            $descricaoanimal = $request->query->get('descricao');
            //restringir a pagina apenas aos ROLE_USER
            $this->denyAccessunlessGranted('ROLE_USER');
            //buscar no bd todos os animais cadastrados
            $query = is_null($descricaoanimal) #condição ternaria#
                ? $animalRepository->findAnimal()
                : $animalRepository->findAnimalByLikeDescricao($descricaoanimal);
            $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                10
            );
            $data['pagination'] = $pagination;
            $data['descricao'] = $descricaoanimal;
            $data['titulo'] = 'Gerenciar Animais';

            return $this->render('animal/index.html.twig', $data);
        } catch (Exception $e) {
            $this->addFlash(
                'error',
                $e->getMessage()
            );
            return $this->redirectToRoute('animal_index');
        }
    }

    #[isGranted('ROLE_USER')]
    #[Route('/animal/cadastrar', name: 'animal_cadastrar')]
    public function adicionar(Request $request, EntityManagerInterface $em, MessageGenerator $messageGenerator): Response
    {
        try {
            //restringir a pagina apenas aos ROLE_USER
            $this->denyAccessunlessGranted('ROLE_USER');

            $animal = new Animal();
            $animal->setStatus(0);
            $form = $this->createForm(AnimalType::class, $animal);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                //Salvar o novo Animal no bd
                $em->persist($animal); //salvar na memoria
                $em->flush();
                $message = $messageGenerator->getMessageCreateSuccess();
                $this->addFlash('notice', $message);
               
                return $this->redirectToRoute('animal_index');
            }


            $data['titulo'] = 'Cadastrar novo animal';
            $data['form'] = $form;

            return $this->renderform('animal/form.html.twig', $data);
        } catch (Exception $e) {
            $this->addFlash(
                'error',
                $e->getMessage()
            );
            return $this->redirectToRoute('animal_index');
        }
    }

    #[isGranted('ROLE_USER')]
    #[Route('/animal/editar/{id}', name: 'animal_editar')]
    public function editar($id, Request $request, EntityManagerInterface $em, AnimalRepository $animalRepository, MessageGenerator $messageGenerator): Response
    {
        try {
            //restringir a pagina apenas aos ROLE_USER
            $this->denyAccessunlessGranted('ROLE_USER');

            $animal = $animalRepository->find($id); //retorna animalpelo $id
            $form = $this->createForm(AnimalType::class, $animal);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $em->flush(); //fazer update do animal no bd
                $message = $messageGenerator->getMessageUpdateSuccess();
                $this->addFlash('notice', $message);
                return $this->redirectToRoute('animal_index');
            }

            $data['titulo'] = 'Editar animal';
            $data['form'] = $form;

            return $this->renderform('animal/form.html.twig', $data);
        } catch (Exception $e) {
            $this->addFlash(
                'error',
                $e->getMessage()
            );
            return $this->redirectToRoute('animal_index');
        }
    }

    #[isGranted('ROLE_USER')]
    #[Route('/animal/excluir/{id}', name: 'animal_excluir')]
    public function excluir($id, EntityManagerInterface $em, AnimalRepository $animalRepository): Response
    {
        try {
            //restringir a pagina apenas aos ROLE_USER
            $this->denyAccessunlessGranted('ROLE_USER');
            $animal = $animalRepository->find($id);
            $em->remove($animal); //excluir animal do bd
            $em->flush(); //excluir o animal do bd
            $this->addFlash(
                'notice',
                'Animal excluído com sucesso!'
            );

            return $this->redirectToRoute('animal_index');
        } catch (Exception $e) {
            $this->addFlash(
                'error',
                $e->getMessage()
            );
            return $this->redirectToRoute('animal_index');
        }
    }

    #[isGranted('ROLE_USER')]
    #[Route('/animal/abaterAnimal/{id}', name: 'animal_abater')]
    public function abaterAnimal($id, EntityManagerInterface $em, AnimalRepository $animalRepository, MessageGenerator $messageGenerator): Response
    {
        try {
            //restringir a pagina apenas aos ROLE_USER
            $this->denyAccessunlessGranted('ROLE_USER');

            $animais = $animalRepository->findAnimalForAbate();
            foreach ($animais as $animalAbate) {                
                if ($animalAbate->getId() == $id) {
                    $animal = $animalRepository->find($id);
                    $animal->setStatus(1);
                    $animal->setDtabate(new DateTime());
                    $em->flush(); //excluir o animal do bd
                    $message = $messageGenerator->getMessageAbaterSuccess();
                    $this->addFlash('notice', $message);
                } 
            }           

            return $this->redirectToRoute('animal_abate');
        } catch (Exception $e) {
            $this->addFlash(
                'error',
                $e->getMessage()
            );
            return $this->redirectToRoute('animal_index');
        }
    }

    #[isGranted('ROLE_USER')]
    #[Route('/animal/relatorioAbate', name: 'animal_abate')]
    public function relatorioAbate(Request $request, AnimalRepository $animalRepository, PaginatorInterface $paginator): Response
    {
        try {
            //restringir a pagina apenas aos ROLE_USER
            $this->denyAccessunlessGranted('ROLE_USER');
            //buscar no bd todos os animais cadastrados
            $query = $animalRepository->findAnimalForAbate();
            $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                10
            );
            $data['titulo'] = "Animais para Abater";
            $data['pagination'] = $pagination;
            return $this->render('animal/relatorio.html.twig', $data);
        } catch (Exception $e) {
            $this->addFlash(
                'error',
                $e->getMessage()
            );
            return $this->redirectToRoute('animal_index');
        }
    }

    #[IsGranted('ROLE_USER')]
    #[Route('/animal/relatorioAnimaisAbatidos', name: 'animais_abatidos')]
    public function relatorioAnimaisAbatidos(Request $request, AnimalRepository $animalRepository, PaginatorInterface $paginator): Response
    {
        try {
            //restringir a pagina apenas aos ROLE_USER
            $this->denyAccessunlessGranted('ROLE_USER');
            //buscar no bd todos os animais cadastrados
            $query = $animalRepository->findByStatus(1);
            $pagination = $paginator->paginate(
                $query,
                $request->query->getInt('page', 1),
                10
            );
            $data['titulo'] = "Animais Abatidos";
            $data['pagination'] = $pagination;
            return $this->render('animal/relatorioAbatidos.html.twig', $data);
        } catch (Exception $e) {
            $this->addFlash(
                'error',
                $e->getMessage()
            );
            return $this->redirectToRoute('animal_index');
        }
    }
}
