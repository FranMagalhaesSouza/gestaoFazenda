<?php

namespace App\Form;

use App\Entity\Animal;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ProducaoLeiteType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('animal', EntityType::class, 
                ['class' => Animal::class, 
                'choice_label' => 'descricao']) 
                
            ->add('qntdLeite', NumberType::class, 
                ['label' => 'Qtd leite produzida semanal:'])

            ->add('dtInicial', DateType::class,
                ['label' => 'Insira data inicial'])

            ->add('dtFinal', DateType::class,
                ['label' => 'Insira data final'])

            ->add ('Salvar', SubmitType::class);
    }
}