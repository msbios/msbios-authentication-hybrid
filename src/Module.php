<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid;

use MSBios\AutoloaderAwareInterface;
use MSBios\AutoloaderAwareTrait;
use MSBios\ModuleAwareInterface;
use MSBios\ModuleAwareTrait;
use MSBios\ModuleInterface;

/**
 * Class Module
 * @package MSBios\Authentication\Hybrid
 */
class Module implements
    ModuleInterface,
    ModuleAwareInterface,
    AutoloaderAwareInterface
{
    use ModuleAwareTrait;
    use AutoloaderAwareTrait;

    /** @const VERSION */
    const VERSION = '1.0.0';
}