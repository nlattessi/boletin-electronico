<?php

namespace Acme\boletinesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class EstablecimientoType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombreEstablecimiento')
            ->add('direccionEstablecimiento')
            ->add('telefonoEstablecimiento')
            ->add('emailEstablecimiento')
            ->add('idInstitucion')
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Acme\boletinesBundle\Entity\Establecimiento'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'acme_boletinesbundle_establecimiento';
    }
}
