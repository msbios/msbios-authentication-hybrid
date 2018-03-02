<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Authentication\Hybrid\Controller\HybridController;
use MSBios\Authentication\Hybrid\IdentityResolver;
use MSBios\Authentication\Hybrid\ProviderManager;
use MSBios\Hybridauth\HybridauthManager;
use Zend\Authentication\AuthenticationService;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class HybridControllerFactory
 * @package MSBios\Authentication\Hybrid\Factory
 */
class HybridControllerFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return HybridController
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new HybridController(
            $container->get(AuthenticationService::class),
            $container->get(HybridauthManager::class),
            $container->get(ProviderManager::class),
            $container->get(IdentityResolver::class)
        );
    }
}
