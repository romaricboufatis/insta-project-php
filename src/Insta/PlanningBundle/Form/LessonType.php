<?php

namespace Insta\PlanningBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class LessonType extends AbstractType
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
            ->add('room', 'entity', array(
                'class' => 'Insta\PlanningBundle\Entity\Room' ,
                'property'=>'name'
            ))
            ->add('promotion', 'entity', array(
                'class' => 'Insta\PlanningBundle\Entity\Promotion' ,
                'property'=>'name'
            ))
            ->add('datetime', 'datetime')
            ->add('duration', 'integer')
            ->add('periodicity', 'checkbox', array('mapped'=>false, 'required'=>false))
            ->add('dateEnd', 'date', array('mapped'=>false))
            ->add('add', 'submit')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Insta\PlanningBundle\Entity\Lesson'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'insta_planningbundle_lesson';
    }
}
