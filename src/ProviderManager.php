<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid;

use MSBios\Authentication\IdentityInterface;

/**
 * Class ProviderManager
 * @package MSBios\Authentication\Hybrid
 */
class ProviderManager implements ProviderManagerInterface
{
    /**
     * @param IdentityInterface $identity
     * @param $identifier
     */
    public function find(IdentityInterface $identity, $identifier)
    {
        // ...
    }

    /**
     * @param IdentityInterface $identity
     * @param \Hybrid_User_Profile $profile
     * @param $identifier
     */
    public function write(IdentityInterface $identity, \Hybrid_User_Profile $profile, $identifier)
    {
        // ...
    }
}