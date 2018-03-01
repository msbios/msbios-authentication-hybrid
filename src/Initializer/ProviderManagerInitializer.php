<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid\Initializer;

use Interop\Container\ContainerInterface;
use MSBios\Authentication\Hybrid\ProviderManager;
use MSBios\Authentication\Hybrid\ProviderManagerAwareInterface;
use Zend\ServiceManager\Initializer\InitializerInterface;

/**
 * Class ProviderManagerInitializer
 * @package MSBios\Authentication\Hybrid\Initializer
 */
class ProviderManagerInitializer implements InitializerInterface
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
        if ($instance instanceof ProviderManagerAwareInterface) {
            $instance->setProviderManager(
                $container->get(ProviderManager::class)
            );
        }
    }

    /**
     * @param $an_array
     * @return ProviderManagerInitializer
     */
    public static function __set_state($an_array)
    {
        return new self();
    }
}
