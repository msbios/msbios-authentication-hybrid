<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid\Resolver;

use MSBios\Authentication\IdentityInterface;

/**
 * Class EmailResolver
 * @package MSBios\Authentication\Hybrid\Resolver
 */
class EmailResolver implements ResolverInterface
{
    /**
     * @param \Hybrid_User_Profile $profile
     * @return bool|IdentityInterface
     */
    public function find(\Hybrid_User_Profile $profile)
    {
        // TODO: Implement find() method.
    }
}