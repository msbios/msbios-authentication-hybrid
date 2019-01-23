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
use Zend\EventManager\AbstractListenerAggregate;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\Mvc\ApplicationInterface;
use Zend\Mvc\MvcEvent;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Class ListenerAggregate
 * @package MSBios\Authentication\Hybrid
 */
class ListenerAggregate extends AbstractListenerAggregate
{
    /**
     * @inheritdoc
     *
     * @param EventManagerInterface $events
     * @param int $priority
     */
    public function attach(EventManagerInterface $events, $priority = 1)
    {
        $this->listeners[] = $events
            ->attach(MvcEvent::EVENT_BOOTSTRAP, [$this, 'onBootstrap'], $priority);
    }

    /**
     * Listen to the bootstrap event
     *
     * @param EventInterface $e
     */
    public function onBootstrap(EventInterface $e)
    {
        /** @var ApplicationInterface $target */
        $target = $e->getTarget();

        /** @var ServiceLocatorInterface $serviceManager */
        $serviceManager = $target->getServiceManager();

        /** @var AuthenticationServiceInterface $authenticationService */
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
