<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBiosTest\Authentication\Hybrid;

use MSBios\Authentication\Hybrid\Module;
use PHPUnit\Framework\TestCase;

/**
 * Class ModuleTest
 * @package MSBiosTest\Authentication\Hybrid
 */
class ModuleTest extends TestCase
{
    /**
     *
     */
    public function testGetConfig()
    {
        $this->assertInternalType('array', (new Module)->getConfig());
    }

    /**
     *
     */
    public function testGetAutoloaderConfig()
    {
        $this->assertInternalType('array', (new Module)->getAutoloaderConfig());
    }
}
