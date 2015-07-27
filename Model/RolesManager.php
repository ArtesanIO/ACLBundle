<?php

namespace ArtesanIO\ACLBundle\Model;

use Doctrine\ORM\EntityManager;
use ArtesanIO\ACLBundle\Utils\SlugerRole as Sluger;

class RolesManager
{

    protected $em;
    protected $class;
    protected $repository;
    protected $sluger;

    public function __construct(EntityManager $em, $class, Sluger $sluger)
    {
        $this->em = $em;
        $this->repository = $em->getRepository($class);
        $metadata = $em->getClassMetadata($class);
        $this->class = $metadata->name;
        $this->sluger = $sluger;
    }

    public function find($id)
    {
        return $this->repository->find($id);
    }

    public function findAll()
    {
        return $this->repository->findAll();
    }

    public function getClass()
    {
        return new $this->class;
    }

    public function save($model)
    {
        $this->_save($model);
    }

    protected function _save($model)
    {
        $model->setRoleKey($this->sluger->slugerfy($model->getRole()));
        $this->em->persist($model);
        $this->em->flush();
    }

    public function update()
    {
        $this->em->flush();
    }

}



?>
