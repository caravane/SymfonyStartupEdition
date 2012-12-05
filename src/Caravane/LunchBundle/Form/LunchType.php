<?php

namespace Caravane\LunchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

use Caravane\LunchBundle\Entity\RestaurantRepository;

class LunchType extends AbstractType
{   
    
    public function getDefaultOptions(array $options) {
        return array(
            'user' => 'Caravane\UserBundle\Entity\User'
        );
    }

    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('category')
            ->add('description')
            ->add('date')
            ->add('price')
            ->add('restaurant','entity',array(
                'class' => 'CaravaneLunchBundle:Restaurant',
                'query_builder' => function(RestaurantRepository $er) use ($options) {
                    return $er->findFromCurrentUser($options['user']);
                },
            ))
        ;
    }

    public function getName()
    {
        return 'caravane_lunchbundle_lunchtype';
    }
}
