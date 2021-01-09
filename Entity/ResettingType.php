<?php

namespace Capersys\UserBundle\Entity;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\FormBuilderInterface;

/**
 * User Password Resetting Form.
 *
 */
class ResettingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('username', EmailType::class, [
                'attr' => ['placeholder' => 'security.login_username'],
                'label' => 'security.login_username',
            ]);
    }
}
