<?php

namespace Insta\PlanningBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PromotionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('color')
            ->add('name')
            ->add('dateStart')
            ->add('dateEnd')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Insta\PlanningBundle\Entity\Promotion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'insta_planningbundle_promotion';
    }
}
