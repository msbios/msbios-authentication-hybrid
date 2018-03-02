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
    public function find(\Hybrid_User_Profile $profile, $identifier)
    {
        // TODO: Implement find() method.
    }

    public function write(IdentityInterface $identity, \Hybrid_User_Profile $profile, $identifier)
    {
        // TODO: Implement write() method.
    }
}
