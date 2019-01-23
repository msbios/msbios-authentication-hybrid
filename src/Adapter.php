<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Authentication\Hybrid;

use MSBios\Authentication\IdentityInterface;
use Zend\Authentication\Result as AuthenticationResult;

/**
 * Class Adapter
 * @package MSBios\Authentication\Hybrid
 */
class Adapter implements AdapterInterface
{
    /** @var IdentityInterface */
    protected $identity;

    /**
     * Adapter constructor.
     * @param IdentityInterface $identity
     */
    public function __construct(IdentityInterface $identity = null)
    {
        $this->identity = $identity;
    }

    /**
     * @inheritdoc
     *
     * @param IdentityInterface|null $identity
     * @return AuthenticationResult
     */
    public function authenticate(IdentityInterface $identity = null)
    {
        /** @var IdentityInterface $identity */
        $identity = $identity ?: $this->identity;

        return new AuthenticationResult(
            AuthenticationResult::SUCCESS,
            $identity,
            ['Authentication successful.']
        );
    }
}
