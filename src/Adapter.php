<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid;

use Zend\Authentication\Adapter\AdapterInterface;

/**
 * Class Adapter
 * @package MSBios\Authentication\Hybrid
 */
class Adapter implements AdapterInterface
{
    /**
     * Performs an authentication attempt
     *
     * @return \Zend\Authentication\Result
     * @throws \Zend\Authentication\Adapter\Exception\ExceptionInterface If authentication cannot be performed
     */
    public function authenticate()
    {
        // TODO: Implement authenticate() method.
    }
}
