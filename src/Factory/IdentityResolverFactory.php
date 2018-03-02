<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Authentication\Hybrid\Factory;

use Interop\Container\ContainerInterface;
use MSBios\Authentication\Hybrid\IdentityResolver;
use MSBios\Authentication\Hybrid\IdentityResolverInterface;
use MSBios\Authentication\Hybrid\Module;
use Zend\ServiceManager\Factory\FactoryInterface;

/**
 * Class IdentityResolverFactory
 * @package MSBios\Authentication\Hybrid\Factory
 */
class IdentityResolverFactory implements FactoryInterface
{
    /**
     * @param ContainerInterface $container
     * @param string $requestedName
     * @param array|null $options
     * @return IdentityResolver|IdentityResolverInterface
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        /** @var IdentityResolverInterface $identityResolver */
        $identityResolver = new IdentityResolver;

        /** @var array $options */
        $options = $container->get(Module::class);

        /**
         * @var string $resolver
         * @var int $priority
         */
        foreach ($options['identity_resolvers'] as $resolver => $priority) {
            if (! $container->has($resolver)) {
                // ... Must be Exception
            }

            $identityResolver->attach(
                $container->get($resolver, $priority)
            );
        }

        return $identityResolver;
    }
}
