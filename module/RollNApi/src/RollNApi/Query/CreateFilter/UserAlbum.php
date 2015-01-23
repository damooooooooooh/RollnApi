<?php

namespace RollNApi\Query\CreateFilter;

use ZF\Apigility\Doctrine\Server\Query\CreateFilter\DefaultCreateFilter ;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZF\ApiProblem\ApiProblem;
use ZF\Rest\ResourceEvent;

class UserAlbum extends DefaultCreateFilter implements ServiceLocatorAwareInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $serviceLocator = null;

    /**
     * Set service locator
     *
     * @param ServiceLocatorInterface $serviceLocator
     * @return mixed
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;

        return $this;
    }

    /**
     * Get service locator
     *
     * @return ServiceLocatorInterface
     */
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }

    /**
     * @param string $entityClass
     * @param array  $data
     *
     * @return array
     */
    public function filter(ResourceEvent $event, $entityClass, $data)
    {
        $request = $this->getServiceLocator()->getServiceLocator()->get('Request')->getQuery()->toArray();
        $identity = $event->getIdentity()->getAuthenticationIdentity();
        $data->user = $identity['user_id'];

        return $data;
    }
}
