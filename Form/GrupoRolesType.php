<?php

namespace ArtesanIO\ACLBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ArtesanIO\ACLBundle\Form\RolesType;

class GrupoRolesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles', 'collection', array(
                'type'          => new GruposRolesType(),
                'allow_add'     => true,
                'by_reference'  => false,
                'allow_delete'  => true,
                'prototype'     => true
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArtesanIO\ACLBundle\Entity\Grupos',
            'cascade_validation' => true
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'artesanio_acl_grupo_roles';
    }
}
