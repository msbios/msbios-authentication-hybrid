<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Authentication\Hybrid;

use MSBios\Authentication\IdentityInterface;
use Zend\Authentication\Adapter\AdapterInterface as DefaultAdapterInterface;

/**
 * Interface AdapterInterface
 * @package MSBios\Authentication\Hybrid
 */
interface AdapterInterface extends DefaultAdapterInterface
{
    /**
     * @inheritdoc
     *
     * @param IdentityInterface|null $identity
     * @return mixed
     */
    public function authenticate(IdentityInterface $identity = null);
}
