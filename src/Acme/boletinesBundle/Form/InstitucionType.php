<?php

namespace Acme\boletinesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class InstitucionType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreInstitucion')
            ->add('direccionInstitucion')
            ->add('telefonoInstitucion')
            ->add('emailInstitucion')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\boletinesBundle\Entity\Institucion'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_boletinesbundle_institucion';
    }
}
