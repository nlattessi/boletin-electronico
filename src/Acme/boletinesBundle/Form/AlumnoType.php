<?php

namespace Acme\boletinesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AlumnoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreAlumno')
            ->add('idEntityRelacionada')
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\boletinesBundle\Entity\Alumno'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_boletinesbundle_alumno';
    }
}
