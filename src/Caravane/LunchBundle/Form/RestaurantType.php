<?php

namespace Caravane\LunchBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class RestaurantType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('description')
            ->add('country')
            ->add('city')
            ->add('address1')
            ->add('address2')
            ->add('zip')
            ->add('status','checkbox')
			->add('lat','hidden')
			->add('lng','hidden')
        ;
    }

    public function getName()
    {
        return 'caravane_lunchbundle_restauranttype';
    }
}
