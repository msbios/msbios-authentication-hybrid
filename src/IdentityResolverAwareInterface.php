<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Authentication\Hybrid;

/**
 * Interface IdentityResolverAwareInterface
 * @package MSBios\Authentication\Hybrid
 */
interface IdentityResolverAwareInterface
{
    /**
     * @return IdentityResolverInterface
     */
    public function getIdentityResolver(): IdentityResolverInterface;

    /**
     * @param IdentityResolverInterface $identityResolver
     * @return $this
     */
    public function setIdentityResolver(IdentityResolverInterface $identityResolver);
}