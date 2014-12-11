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
                'property'=>'name',
                'label' => 'schedule.course'
            ))
            ->add('room', 'entity', array(
                'class' => 'Insta\PlanningBundle\Entity\Room' ,
                'property'=>'name',
                'label'=>'schedule.room'
            ))
            ->add('promotion', 'entity', array(
                'class' => 'Insta\PlanningBundle\Entity\Promotion' ,
                'property'=>'name',
                'label'=>'schedule.promotion'
            ))
            ->add('datetime', 'datetime', array('label'=>'schedule.datetime'))
            ->add('duration', 'integer', array('label'=>'schedule.duration'))
            ->add('periodicity', 'checkbox', array('mapped'=>false, 'required'=>false, 'label'=>'schedule.periodicity'))
            ->add('dateEnd', 'date', array('mapped'=>false, 'label'=>'schedule.periodicity_end'))
            ->add('add', 'submit', array('label'=>'form.add'))
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
