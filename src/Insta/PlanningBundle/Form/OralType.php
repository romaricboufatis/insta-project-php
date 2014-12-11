<?php

namespace Insta\PlanningBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class OralType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('course', 'entity', array(
                'class' => 'Insta\PlanningBundle\Entity\Course' ,
                'property'=>'name'
            ))
            ->add('students', 'entity', array(
                'class' => 'Insta\PlanningBundle\Entity\Student',
                'property' => 'fullname',
                'multiple'=> true,
                'group_by' => 'promotion.name'
            ))
            ->add('room', 'entity', array(
                'class' => 'Insta\PlanningBundle\Entity\Room' ,
                'property'=>'name'
            ))
            ->add('datetime', 'datetime')
            ->add('duration', 'integer')
            ->add('add', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Insta\PlanningBundle\Entity\Oral'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'insta_planningbundle_oral';
    }
}
