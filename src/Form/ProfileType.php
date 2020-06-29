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

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Security\Core\Validator\Constraints\UserPassword;
use Symfony\Component\Validator\Constraints\NotBlank;

class ProfileType extends AbstractType
{
//    public function buildForm(FormBuilderInterface $builder, array $options)
//    {
//        $this->buildUserForm($builder, $options);
//
//        $constraintsOptions = array(
//            'message' => 'fos_user.current_password.invalid',
//        );
//
//        if (!empty($options['validation_groups'])) {
//            $constraintsOptions['groups'] = array(reset($options['validation_groups']));
//        }
//
//        $builder->add('current_password', PasswordType::class, array(
//            'label' => 'form.current_password',
//            'translation_domain' => 'FOSUserBundle',
//            'mapped' => false,
//            'constraints' => array(
//                new NotBlank(),
//                new UserPassword($constraintsOptions),
//            ),
//            'attr' => array(
//                'autocomplete' => 'current-password',
//            ),
//        ));
//    }
//
//    /**
//     * {@inheritdoc}
//     */
//    public function configureOptions(OptionsResolver $resolver)
//    {
//        $resolver->setDefaults(array(
//            'data_class' => $this->class,
//            'csrf_token_id' => 'profile',
//        ));
//    }

    // BC for SF < 3.0
//
//    /**
//     * {@inheritdoc}
//     */
//    public function getName()
//    {
//        return $this->getBlockPrefix();
//    }

    public function getParent()
    {
        return 'FOS\UserBundle\Form\Type\ProfileFormType';
    }
//    /**
//     * {@inheritdoc}
//     */
    public function getBlockPrefix()
    {
        return 'fos_user_profile_edit';
    }

    /**
     * Builds the embedded form representing the user.
     *
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildUserForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('username', null, array('label' => 'form.username', 'translation_domain' => 'FOSUserBundle'))
            ->add('firstname')
            ->add('lastname')
            ->add('email', EmailType::class, array('label' => 'form.email', 'translation_domain' => 'FOSUserBundle'))
            ->add('birthdate', null, array(
                'widget' => 'choice',
                'years' => range(1900, 2500),
            ))
            ->add('path', FileType::class, array(
                'required'=>false
            ))
            ->add('cin', \Symfony\Component\Form\Extension\Core\Type\IntegerType::class)
            ->add('gender', ChoiceType::class, array(
                'choices' => ['F' => 'F', 'M' => 'M']
            ));
        ;
    }
}