<?php

namespace ArtesanIO\ACLBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use ArtesanIO\ACLBundle\Form\EventListener\UsuariosSubscriber;

class UsuariosType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('grupos', 'entity', array(
                'class' => 'ArtesanIO\ACLBundle\Entity\Grupos',
                'property' => 'grupo'
            ))
            ->add('nombre')
            ->add('username')
            ->add('email')
            ->add('isActive')
        ;

        $builder->addEventSubscriber(new UsuariosSubscriber());
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ArtesanIO\ACLBundle\Entity\Usuarios'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'artesanio_acl_usuarios';
    }
}
