<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AnimalType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder

            ->add('descricao', TextType::class, 
                ['label' => 'Informação do animal:'])
            ->add('peso', NumberType::class, 
                ['label' => 'Peso do animal:']) 
            ->add('qtdleite', NumberType::class, 
                ['label' => 'Produção de leite por semana:']) 
            ->add('qtdracao', NumberType::class, 
                ['label' => 'Consumo de ração por semana:'])                 
            ->add('dtNasc', DateType::class, 
                ['label' => 'Data de nascimento do animal:'])

            ->add ('Salvar', SubmitType::class);
    }
}