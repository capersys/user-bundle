<?php

namespace Capersys\UserBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Length;

/**
 * User Password Reset.
 *
 */
class ResettingPasswordType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('plainPassword', RepeatedType::class, [
                'mapped' => false,
                'type' => PasswordType::class,
                'first_options' => [
                    'attr' => ['placeholder' => 'security.password'],
                    'label' => 'security.password'
                ],
                'second_options' => [
                    'attr' => ['placeholder' => 'security.password_confirmation'],
                    'label' => 'security.password_confirmation'
                ],
                'constraints' => [
                    new Length([
                        'min' => 3,
                        'max' => 4096,
                    ]),
                ],
                'invalid_message' => 'password_dont_match',
            ]);
    }
}
