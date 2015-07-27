<?php

namespace ArtesanIO\ACLBundle\Security;

use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\Exception\UsernameNotFoundException;
use Symfony\Component\Security\Core\Exception\UnsupportedUserException;
use ArtesanIO\ACLBundle\Model\UsuariosManager;
use ArtesanIO\ACLBundle\Security\UsuariosService;

class UsuariosProvider implements UserProviderInterface
{
    protected $usuarios;

    public function __construct(UsuariosManager $usuarios)
    {
        $this->usuarios = $usuarios;
    }

    public function loadUserByUsername($username)
    {
        try{
            $usuario = $this->usuarios->usernameOREmail($username);
        }catch (NoResultException $e){
            throw new UsernameNotFoundException(sprintf('"%s" no existe', $username));
        }

        $username = $usuario->getUsername();
        $password = $usuario->getPassword();
        $salt     = $usuario->getSalt();
        $roles    = array('ROLE_ADMIN', 'ROLE_USER');

        return new UsuariosService($username, $password, $salt, $roles);
    }

    public function refreshUser(UserInterface $user)
    {   
        if (!$user instanceof UsuariosService) {
            throw new UnsupportedUserException(
                sprintf('Instances of "%s" are not supported.', get_class($user))
            );
        }

        return $this->loadUserByUsername($user->getUsername());
    }

    public function supportsClass($class)
    {
        return $class === 'ArtesanIO\ACLBundle\Security\UsuariosService';
    }
}


?>
