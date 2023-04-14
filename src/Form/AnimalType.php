<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AnimalType extends AbstractType {

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('qntdLeite', IntegerType::class, 
                ['label' => 'Quantidade de leite produzido semanalmente:'])

            ->add('qntdRacao', IntegerType::class, 
                ['label' => 'Quantidade de ração consumida semanalmente:'])
                
            ->add('peso', IntegerType::class, 
                ['label' => 'Peso do animal:']) 
                
            ->add('dtNasc', DateType::class, 
                ['label' => 'Data de nascimento do animal:'])

            ->add ('Salvar', SubmitType::class);
    }
}