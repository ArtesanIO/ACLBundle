<?php

namespace ArtesanIO\ACLBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class GruposController extends Controller
{
    public function gruposAction()
    {
        $grupos = $this->get('artesanio.grupos_manager')->findAll();

        return $this->render('ACLBundle:Grupos:grupos.html.twig', array(
            'grupos' => $grupos
        ));
    }

    public function crearAction(Request $request)
    {
        $grupo = $this->get('artesanio.grupos_manager')->getClass();

        $grupoForm = $this->createForm('artesanio_acl_grupos', $grupo)->handleRequest($request);

        if($grupoForm->isValid()){

            $this->get('artesanio.grupos_manager')->save($grupo);

            return $this->redirect($this->generateUrl('grupo', array('id' => $grupo->getId())));
        }

        return $this->render('ACLBundle:Grupos:grupos-crear.html.twig', array(
            'grupo_form' => $grupoForm->createView()
        ));
    }

    public function grupoAction(Request $request, $id)
    {
        $grupo = $this->get('artesanio.grupos_manager')->find($id);

        $rolesOriginal = $this->get('artesanio.grupos_manager')->rolesOriginal($grupo);

        $grupoForm = $this->createForm('artesanio_acl_grupos', $grupo)->handleRequest($request);

        if($grupoForm->isValid()){

            $this->get('artesanio.grupos_manager')->update();
            return $this->redirect($this->generateUrl('grupo', array('id' => $grupo->getId())));
        }
        
        $gruposRolesForm = $this->createForm('artesanio_acl_grupo_roles', $grupo)->handleRequest($request);

        if($gruposRolesForm->isValid()){

            $this->get('artesanio.grupos_manager')->updateRoles($rolesOriginal, $grupo);
            return $this->redirect($this->generateUrl('grupo', array('id' => $grupo->getId())));
        }

        return $this->render('ACLBundle:Grupos:grupo.html.twig', array(
            'grupo'            => $grupo,
            'grupo_form'       => $grupoForm->createView(),
            'grupo_roles_form' => $gruposRolesForm->createView()
        ));
    }
}
