<?php

namespace RollNApi;

use ZF\Apigility\Provider\ApigilityProviderInterface;
use Zend\Console\Console;
use Zend\Mvc\MvcEvent;

class Module implements ApigilityProviderInterface
{
    public function onBootstra(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $eventManager->attach(MvcEvent::EVENT_DISPATCH, array($this, 'onDispatch'));
    }

    public function onDispatch(MvcEvent $e)
    {
        if (!Console::isConsole()) {
            $server = $e->getApplication()->getServiceManager()->get('ZF\OAuth2\Service\OAuth2Server');

            if (!$server->verifyResourceRequest(OAuth2Request::createFromGlobals())) {
                throw new \Exception('Not Authorized');
            }
        }
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
}
