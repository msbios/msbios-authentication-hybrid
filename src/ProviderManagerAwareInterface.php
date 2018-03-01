<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid;

/**
 * Interface ProviderManagerAwareInterface
 * @package MSBios\Authentication\Hybrid
 */
interface ProviderManagerAwareInterface
{
    /**
     * @return ProviderManagerInterface
     */
    public function getProviderManager();

    /**
     * @param ProviderManagerInterface $providerManager
     * @return $this
     */
    public function setProviderManager(ProviderManagerInterface $providerManager);
}
