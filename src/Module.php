<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Authentication\Hybrid;

use MSBios\Authentication\AuthenticationService;
use MSBios\AutoloaderAwareInterface;
use MSBios\Hybridauth\HybridauthManager;
use MSBios\Hybridauth\HybridauthManagerInterface;
use MSBios\ModuleAwareInterface;
use MSBios\ModuleInterface;
use Zend\Authentication\AuthenticationService as DefaultAuthenticationService;
use Zend\Authentication\AuthenticationServiceInterface as DefaultAuthenticationServiceInterface;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\Loader\AutoloaderFactory;
use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature\BootstrapListenerInterface;
use Zend\Mvc\ApplicationInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class Module
 * @package MSBios\Authentication\Hybrid
 */
class Module implements
    ModuleInterface,
    ModuleAwareInterface,
    AutoloaderAwareInterface,
    BootstrapListenerInterface
{

    /** @const VERSION */
    const VERSION = '1.0.20';

    /**
     * Returns configuration to merge with application configuration
     *
     * @return array|\Traversable
     */
    public function getConfig()
    {
        return include __DIR__ . '/../config/module.config.php';
    }

    /**
     * Return an array for passing to Zend\Loader\AutoloaderFactory.
     *
     * @return array
     */
    public function getAutoloaderConfig()
    {
        return [
            AutoloaderFactory::STANDARD_AUTOLOADER => [
                StandardAutoloader::LOAD_NS => [
                    __NAMESPACE__ => __DIR__,
                ],
            ],
        ];
    }

    /**
     * Listen to the bootstrap event
     *
     * @param EventInterface $e
     * @return array
     */
    public function onBootstrap(EventInterface $e)
    {
        /** @var ApplicationInterface $target */
        $target = $e->getTarget();

        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $target->getServiceManager();

        /** @var DefaultAuthenticationServiceInterface $authenticationService */
        $authenticationService = $serviceManager->get(DefaultAuthenticationService::class);

        if ($authenticationService instanceof DefaultAuthenticationServiceInterface) {
            /** @var EventManagerInterface $eventManager */
            $eventManager = $authenticationService->getEventManager();
            $eventManager->attach(AuthenticationService::EVENT_CLEAR_IDENTITY, [$this, 'onClearIdentity']);
        }
    }

    /**
     * @param EventInterface $e
     */
    public function onClearIdentity(EventInterface $e)
    {
        /** @var HybridauthManagerInterface $hybridauthManager */
        $hybridauthManager = $e->getTarget()
            ->getServiceManager()
            ->get(HybridauthManager::class);
        $hybridauthManager->clearProviders();
    }
}
