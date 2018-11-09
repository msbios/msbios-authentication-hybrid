<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid\Controller;

use MSBios\Application\Controller\IndexController as DefaultIndexController;
use MSBios\Hybridauth\HybridauthManagerAwareInterface;
use MSBios\Hybridauth\HybridauthManagerAwareTrait;

/**
 * Class IndexController
 * @package MSBios\Authentication\Hybrid\Controller
 */
class IndexController extends DefaultIndexController implements HybridauthManagerAwareInterface
{
    use HybridauthManagerAwareTrait;
}