<?php

namespace ArtesanIO\ACLBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class UsuariosController extends Controller
{
    public function usuariosAction()
    {
        $usuarios = $this->get('artesanio.usuarios_manager')->findAll();

        return $this->render('ACLBundle:Usuarios:usuarios.html.twig', array(
            'usuarios' => $usuarios
        ));
    }

    public function crearAction(Request $request)
    {
        $usuario = $this->get('artesanio.usuarios_manager')->getClass();

        $usuarioForm = $this->createForm('artesanio_acl_usuarios', $usuario)->handleRequest($request);

        if($usuarioForm->isValid()){

            $this->get('artesanio.usuarios_manager')->save($usuario);

            return $this->redirect($this->generateUrl('usuario', array('id' => $usuario->getId())));
        }

        return $this->render('ACLBundle:Usuarios:usuarios-crear.html.twig', array(
            'usuario_form' => $usuarioForm->createView()
        ));
    }

    public function usuarioAction(Request $request, $id)
    {
        $usuario = $this->get('artesanio.usuarios_manager')->find($id);

        $usuarioForm = $this->createForm('artesanio_acl_usuarios', $usuario)->handleRequest($request);

        if($usuarioForm->isValid()){

            $this->get('artesanio.usuarios_manager')->update();

            return $this->redirect($this->generateUrl('usuario', array('id' => $usuario->getId())));
        }

        $usuarioPasswordForm = $this->createForm('artesanio_acl_usuarios_password', $usuario)->handleRequest($request);

        if($usuarioPasswordForm->isValid()){

            $this->get('artesanio.usuarios_manager')->updatePassword($usuario, $usuarioPasswordForm);

            return $this->redirect($this->generateUrl('usuarios'));
        }

        return $this->render('ACLBundle:Usuarios:usuario.html.twig', array(
            'usuario_form' => $usuarioForm->createView(),
            'usuario_password_form' => $usuarioPasswordForm->createView()
        ));
    }
}
