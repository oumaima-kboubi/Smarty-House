<?php

/*
 * This file is part of the FOSUserBundle package.
 *
 * (c) FriendsOfSymfony <http://friendsofsymfony.github.com/>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace App\Form;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CountryType;

use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class EditProfilePersonalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {  $constraintsOptions = array(
        'message' => 'fos_user.current_password.invalid',
    );
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('birthdate', null, array(
                'widget' => 'choice',
                'years' => range(1900, 2500),
            ))
            ->add('path', FileType::class, array(
                'mapped' => false,
                'required' => false,
                'constraints' => array(
                    new \Symfony\Component\Validator\Constraints\Image()
                )
            ))
            ->add('cin')
            ->add('gender', ChoiceType::class, array(
                'choices' => ['F' => 'F', 'M' => 'M']
            ))
            ->add('country', CountryType::class)
            ->add('current_password', PasswordType::class, array(
                'label' => 'form.current_password',
                'translation_domain' => 'FOSUserBundle',
                'mapped' => false,
                'constraints' => array(
                    new NotBlank(),
                    new UserPassword($constraintsOptions),
                ),
                'attr' => array(
                    'autocomplete' => 'current-password',
                ),
            ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
            'csrf_token_id' => 'profile'
        ]);
    }
}
