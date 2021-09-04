<?php

namespace App\Controller;

use Doctrine\ORM\EntityManager;
use EasyCorp\Bundle\EasyAdminBundle\Controller\EasyAdminController;
use Symfony\Component\HttpFoundation\Request;

class StudentController extends EasyAdminController
{
    /** @var array The full configuration of the entire backend */
    protected $config;
    /** @var array The full configuration of the current entity */
    protected $entity;
    /** @var Request The instance of the current Symfony request */
    protected $request;
    /** @var EntityManager The Doctrine entity manager for the current entity */
    protected $em;

    protected function createListQueryBuilder($entityClass, $sortDirection, $sortField = null, $dqlFilter = null): \Doctrine\ORM\QueryBuilder
    {
        $result = parent::createListQueryBuilder($entityClass, $sortDirection, $sortField, $dqlFilter);

        if (method_exists($entityClass, 'getUser')) {
            $result->andWhere('entity.user = :user');
            $result->setParameter('user', $this->getUser());
        }

        return $result;
    }

    protected function createSearchQueryBuilder($entityClass, $searchQuery, array $searchableFields, $sortField = null, $sortDirection = null, $dqlFilter = null): \Doctrine\ORM\QueryBuilder
    {
        $result = parent::createSearchQueryBuilder($entityClass, $searchQuery, $searchableFields, $sortField, $sortDirection, $dqlFilter);

        if (method_exists($entityClass, 'getUser')) {
            $result->andWhere('entity.user = :user');
            $result->setParameter('user', $this->getUser());
        }

        return $result;
    }

    protected function showAction(): \Symfony\Component\HttpFoundation\Response
    {
        $easyadmin = $this->request->attributes->get('easyadmin');
        $entity = $easyadmin['item'];

        if ($entity->getUser() !== $this->getUser()) {
            throw new AccessDeniedException();
        }

        $result = parent::showAction();

        return $result;
    }

    protected function createEditForm($entity, array $entityProperties)
    {
        $result = parent::createEditForm($entity, $entityProperties);

        if ($entity->getUser() !== $this->getUser()) {
            throw new AccessDeniedException();
        }

        return $result;
    }

    protected function deleteAction()
    {
        $easyadmin = $this->request->attributes->get('easyadmin');
        $entity = $easyadmin['item'];

        if ($entity->getUser() !== $this->getUser()) {
            throw new AccessDeniedException();
        }

        $result = parent::deleteAction();

        return $result;

    }

    protected function persistEntity($entity)
    {
        $entity->setUser($this->getUser());

        return parent::persistEntity($entity);
    }
}