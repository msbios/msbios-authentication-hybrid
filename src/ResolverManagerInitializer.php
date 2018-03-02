<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid\Initializer;

use Interop\Container\ContainerInterface;
use MSBios\Authentication\Hybrid\IdentityResolver;
use MSBios\Authentication\Hybrid\IdentityResolverAwareInterface;
use Zend\ServiceManager\Initializer\InitializerInterface;

/**
 * Class ResolverManagerInitializer
 * @package MSBios\Authentication\Hybrid\Initializer
 */
class ResolverManagerInitializer implements InitializerInterface
{
    /**
     * Initialize the given instance
     *
     * @param  ContainerInterface $container
     * @param  object $instance
     * @return void
     */
    public function __invoke(ContainerInterface $container, $instance)
    {
        if ($instance instanceof IdentityResolverAwareInterface) {
            $instance->setResolverManager(
                $container->get(IdentityResolver::class)
            );
        }
    }

    /**
     * @param $an_array
     * @return ResolverManagerInitializer
     */
    public static function __set_state($an_array)
    {
        return new self();
    }
}
