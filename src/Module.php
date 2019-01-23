<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Authentication\Hybrid;

use MSBios\Authentication\AuthenticationService;
use MSBios\Authentication\AuthenticationServiceInterface;
use MSBios\Hybridauth\HybridauthManager;
use MSBios\Hybridauth\HybridauthManagerInterface;
use Zend\Authentication\AuthenticationService as DefaultAuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface as DefaultAuthenticationServiceInterface;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\ApplicationInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class Module
 * @package MSBios\Authentication\Hybrid
 */
class Module extends \MSBios\Module implements BootstrapListenerInterface
{
    /** @const VERSION */
    const VERSION = '1.0.25';

    /**
     * @inheritdoc
     *
     * @return string
     */
    protected function getDir()
    {
        return __DIR__;
    }

    /**
     * @inheritdoc
     *
     * @return string
     */
    protected function getNamespace()
    {
        return __NAMESPACE__;
    }

    /**
     * @inheritdoc
     *
     * @param EventInterface $e
     * @return array|void
     */
    public function onBootstrap(EventInterface $e)
    {
        /** @var ApplicationInterface $target */
        $target = $e->getTarget();

        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $target->getServiceManager();

        /** @var DefaultAuthenticationServiceInterface $authenticationService */
        $authenticationService = $serviceManager->get(DefaultAuthenticationService::class);

        if ($authenticationService instanceof AuthenticationServiceInterface) {
            /** @var EventManagerInterface $eventManager */
            $eventManager = $authenticationService->getEventManager();

            /** @var callable $onClearIdentity */
            $onClearIdentity = function (EventInterface $event) use ($serviceManager) {
                /** @var HybridauthManagerInterface $hybridauthManager */
                $hybridauthManager = $serviceManager->get(HybridauthManager::class);
                $hybridauthManager->clearProviders();
            };

            $eventManager->attach(AuthenticationService::EVENT_CLEAR_IDENTITY, $onClearIdentity);
        }
    }
}
