<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid;

use MSBios\Authentication\IdentityInterface;

/**
 * Interface ProviderManagerInterface
 * @package MSBios\Authentication\Hybrid
 */
interface ProviderManagerInterface
{
    /**
     * @param \Hybrid_User_Profile $profile
     * @param $identifier
     * @param IdentityInterface|null $identity
     * @return mixed
     */
    public function find(\Hybrid_User_Profile $profile, $identifier, IdentityInterface $identity = null);

    /**
     * @param IdentityInterface $identity
     * @param \Hybrid_User_Profile $profile
     * @param $identifier
     * @return mixed
     */
    public function write(IdentityInterface $identity, \Hybrid_User_Profile $profile, $identifier);
}
