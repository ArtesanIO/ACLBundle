<?php

namespace ArtesanIO\ACLBundle\Model;

use Doctrine\ORM\EntityManager;
use ArtesanIO\ACLBundle\Utils\Encoder;

class UsuariosManager
{

    protected $em;
    protected $class;
    protected $repository;
    protected $encoder;

    public function __construct(EntityManager $em, $class, Encoder $encoder)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
        $this->encoder = $encoder;
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function usernameOREmail($username)
    {
        return $this->repository->findUsernameOREmail($username);
    }

    public function getClass()
    {
        return new $this->class;
    }

    public function save($model)
    {
        $model->setPassword($this->encoder->setUserPassword($model, $model->getPassword()));
        $this->_save($model);
    }

    protected function _save($model)
    {
        $this->em->persist($model);
        $this->em->flush();
    }

    public function update()
    {
        $this->em->flush();
    }

    public function updatePassword($model, $dataForm)
    {
        $data = $dataForm->getData();
        $model->setPassword($this->encoder->setUserPassword($model, $data->getPassword()));
        $this->_save($model);
    }

}



?>
