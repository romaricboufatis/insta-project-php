<?php

namespace Insta\PlanningBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class SiteType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name')
            ->add('zipCode')
            ->add('street')
            ->add('city')
            ->add('phoneNumber')
            ->add('subwayLines')
            ->add('subwayStop')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Insta\PlanningBundle\Entity\Site'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'insta_planningbundle_site';
    }
}
