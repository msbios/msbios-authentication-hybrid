<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid;

use MSBios\Authentication\Hybrid\Resolver\ResolverInterface;

/**
 * Interface IdentityResolverInterface
 * @package MSBios\Authentication\Hybrid
 */
interface IdentityResolverInterface extends ResolverInterface
{
    /**
     * @param ResolverInterface $resolver
     * @param int $priority
     * @return mixed
     */
    public function attach(ResolverInterface $resolver, $priority = 1);
}