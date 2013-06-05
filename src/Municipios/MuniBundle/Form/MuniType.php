<?php

namespace Municipios\MuniBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MuniType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nombre')
            ->add('direccion')
            ->add('telefono')
            ->add('email')
            ->add('representante')
            ->add('observaciones')
            ->add('fax')
            ->add('foto')
            ->add('ubicacion')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Municipios\MuniBundle\Entity\Muni'
        ));
    }

    public function getName()
    {
        return 'municipios_munibundle_munitype';
    }
}
