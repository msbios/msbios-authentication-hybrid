<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Authentication\Hybrid;

use MSBios\Authentication\Hybrid\Resolver\ResolverInterface;
use MSBios\Authentication\IdentityInterface;
use Zend\Stdlib\PriorityQueue;

/**
 * Class IdentityResolver
 * @package MSBios\Authentication\Hybrid
 */
class IdentityResolver implements IdentityResolverInterface
{
    /**
     * @var PriorityQueue|ResolverInterface[]
     */
    protected $queue;

    /**
     * Constructor
     *
     * Instantiate the internal priority queue
     */
    public function __construct()
    {
        $this->queue = new PriorityQueue;
    }

    /**
     * @param \Hybrid_User_Profile $profile
     * @return bool|IdentityInterface
     */
    public function find(\Hybrid_User_Profile $profile)
    {
        if (count($this->queue)) {
            /** @var ResolverInterface $resolver */
            foreach ($this->queue as $resolver) {

                /** @var IdentityInterface $identity */
                if ($identity = $resolver->find($profile)) {
                    return $identity;
                }
            }
        }
        return false;
    }

    /**
     * @param ResolverInterface $resolver
     * @param int $priority
     * @return $this
     */
    public function attach(ResolverInterface $resolver, $priority = 1)
    {
        $this->queue->insert($resolver, $priority);
        return $this;
    }
}
