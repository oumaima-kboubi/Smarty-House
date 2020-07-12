<?php
// src/Form/RegistrationType.php

namespace App\Form;

use Doctrine\DBAL\Types\DateType;
use Doctrine\DBAL\Types\IntegerType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('lastname')
            ->add('firstname')
            ->add('birthdate', null, array(
                'widget' => 'choice',
                'years' => range(1900, 2500),
            ))
//            ->add('path', FileType::class, array(
//                'required'=>false,
//                'mapped'=>false
//            ))
            ->add('cin', \Symfony\Component\Form\Extension\Core\Type\IntegerType::class)
            ->add('gender', ChoiceType::class, array(
                'choices' => ['F' => 'F', 'M' => 'M']
            ))
            ->add('country',CountryType::class);
        ;
    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\RegistrationFormType';

        // Or for Symfony < 2.8
        // return 'fos_user_registration';
    }

    public function getBlockPrefix()
    {
        return 'app_user_registration';
    }

    // For Symfony 2.x
    public function getName()
    {
        return $this->getBlockPrefix();
    }


}
