<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid;

/**
 * Class ProviderManagerAwareTrait
 * @package MSBios\Authentication\Hybrid
 */
trait ProviderManagerAwareTrait
{
    /** @var  ProviderManagerInterface */
    protected $providerManager;

    /**
     * @return ProviderManagerInterface
     */
    public function getProviderManager()
    {
        return $this->providerManager;
    }

    /**
     * @param ProviderManagerInterface $providerManager
     * @return $this
     */
    public function setProviderManager(ProviderManagerInterface $providerManager)
    {
        $this->providerManager = $providerManager;
        return $this;
    }
}
