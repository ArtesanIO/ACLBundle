<?php

namespace ArtesanIO\ACLBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GruposRolesType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('roles', 'entity', array(
                'class' => 'ArtesanIO\ACLBundle\Entity\Roles',
                'property' => 'Role',
            ))
        ;
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArtesanIO\ACLBundle\Entity\GruposRoles'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'artesanio_acl_grupos_roles';
    }
}
