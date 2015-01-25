<?php

namespace RollNApi\Query\Provider\UserAlbum;

use ZF\Apigility\Doctrine\Server\Query\Provider\DefaultOrm;
use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use ZF\Rest\ResourceEvent;
use OAuth2\Request as OAuth2Request;
use ZF\ApiProblem\ApiProblem;

class FetchAllQueryProvider extends DefaultOrm implements ServiceLocatorAwareInterface
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

    public function createQuery(ResourceEvent $event, $entityClass, $parameters)
    {
        $server = $this->getServiceLocator()->getServiceLocator()->get('ZF\OAuth2\Service\OAuth2Server');
        if ( ! $server->verifyResourceRequest(OAuth2Request::createFromGlobals(), $response = null, $scope = 'scope2')) {
           return new ApiProblem(401, "Access to UserAlbum FetchAll requires scope 'scope2'");
        }

        $request = $this->getServiceLocator()->getServiceLocator()->get('Request')->getQuery()->toArray();
        $identity = $event->getIdentity()->getAuthenticationIdentity();
        $userId = $identity['user_id'];

        $user = $this->getObjectManager()->getRepository('RollNApi\Entity\User')->find($userId);

        $queryBuilder = $this->getObjectManager()->createQueryBuilder();
        $queryBuilder->select('row')
            ->from($entityClass, 'row')
            ->andwhere('row.user = :user')
            ->setParameter('user', $user)
            ;

        if (isset($request['filter'])) {
            $metadata = $this->getObjectManager()->getMetadataFactory()->getAllMetadata();
            $filterManager = $this->getServiceLocator()->getServiceLocator()->get('ZfDoctrineQueryBuilderFilterManagerOrm');
            $filterManager->filter(
                $queryBuilder,
                $metadata[0],
                $request['filter']
            );
        }

        if (isset($request['order-by'])) {
            $metadata = $this->getObjectManager()->getMetadataFactory()->getAllMetadata();
            $orderByManager = $this->getServiceLocator()->getServiceLocator()->get('ZfDoctrineQueryBuilderOrderByManagerOrm');
            $orderByManager->orderBy(
                $queryBuilder,
                $metadata[0],
                $request['order-by']
            );
        }

        return $queryBuilder;
    }
}
