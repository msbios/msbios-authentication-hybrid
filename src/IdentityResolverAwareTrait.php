<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid;

/**
 * Trait IdentityResolverAwareTrait
 * @package MSBios\Authentication\Hybrid
 */
trait IdentityResolverAwareTrait
{
    /** @var IdentityResolverInterface */
    protected $identityResolver;

    /**
     * @return IdentityResolverInterface
     */
    public function getIdentityResolver(): IdentityResolverInterface
    {
        return $this->identityResolver;
    }

    /**
     * @param IdentityResolverInterface $identityResolver
     * @return $this
     */
    public function setIdentityResolver(IdentityResolverInterface $identityResolver)
    {
        $this->identityResolver = $identityResolver;
        return $this;
    }
}
