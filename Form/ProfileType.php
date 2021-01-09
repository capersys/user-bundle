<?php
/*
 * This file is part of the UserBundle package
 *
 * @author Christ Wood
 * @link https://github.com/Capersys/userBundle
 *
 * The MIT License (MIT)
 * Copyright (c) 2021
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy of this software
 * and associated documentation files (the "Software"), to deal in the Software without restriction,
 * including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense,
 * and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in all copies or substantial
 * portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED
 * TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL
 * THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT,
 * TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */


namespace Capersys\UserBundle\Form;

use Capersys\UserBundle\Entity\ProfileInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Intl\Languages;
use Symfony\component\Intl\Countries;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Type;

/**
 * User Profile Type.
 *
 */
class ProfileType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // Add Email
        $builder->add('email', EmailType::class, [
                'label' => 'security.email',
            ]
        );

        // Add Profile Section
        $builder->add(
            $builder
                ->create('profile', FormType::class, [
                    'label' => false,
                    'attr' => ['class' => 'col-12'],
                    'data_class' => ProfileInterface::class,
                ])
                ->add('firstname', TextType::class, [
                    'label' => 'firstname',
                ])
                ->add('lastname', TextType::class, [
                    'label' => 'lastname',
                ])
                ->add('phone', TextType::class, [
                    'label' => 'phone',
                    'required' => false,
                    'constraints' => [
                        new Type(['type' => 'numeric']),
                    ],
                ])
                ->add('website', TextType::class, [
                    'label' => 'website',
                    'required' => false,
                ])
                ->add('company', TextType::class, [
                    'label' => 'company',
                    'required' => false,
                ])
                ->add('language', ChoiceType::class, [
                    'label' => 'language',
                    'choices' => $this->getLanguageList($options['parameter_bag']),
                    'choice_translation_domain' => false,
                ])
                ->add('country', ChoiceType::class, [
                    'label' => 'country',
                    'choices' => $this->getCountryList($options['parameter_bag']),
                    'choice_translation_domain' => false,
                ])
        );

        // Add Submit
        $builder->add('submit', SubmitType::class, [
            'label' => 'save',
        ]);
    }

    /**
     * Set Default Options.
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setRequired('parameter_bag');
    }

    /**
     * Return Active Language List.
     *
     * @return array|bool
     */
    public function getLanguageList(ParameterBagInterface $bag)
    {
        return array_flip(array_intersect_key(Languages::getNames(), array_flip($bag->get('active_language'))));
    }

  /**
     * Return Active Country List.
     *
     * @return array|bool
     */
    public function getCountryList(ParameterBagInterface $bag)
    {
        return array_flip(array_intersect_key(Countries::getNames(), array_flip($bag->get('active_language'))));
    }
}