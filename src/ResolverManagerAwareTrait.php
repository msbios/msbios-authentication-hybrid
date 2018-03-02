<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid;

/**
 * Trait ResolverManagerAwareTrait
 * @package MSBios\Authentication\Hybrid
 */
trait ResolverManagerAwareTrait
{
    /** @var  IdentityResolverInterface */
    protected $resolverManager;

    /**
     * @return IdentityResolverInterface
     */
    public function getResolverManager(): IdentityResolverInterface
    {
        return $this->resolverManager;
    }

    /**
     * @param IdentityResolverInterface $resolverManager
     * @return $this
     */
    public function setResolverManager(IdentityResolverInterface $resolverManager)
    {
        $this->resolverManager = $resolverManager;
        return $this;
    }
}