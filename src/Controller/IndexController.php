<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */
namespace MSBios\Authentication\Hybrid\Controller;

use MSBios\Application\Controller\IndexController as DefaultIndexController;
use MSBios\Hybridauth\HybridauthAwareInterface;
use MSBios\Hybridauth\HybridauthAwareTrait;

/**
 * Class IndexController
 * @package MSBios\Authentication\Hybrid\Controller
 */
class IndexController extends DefaultIndexController implements HybridauthAwareInterface
{
    use HybridauthAwareTrait;

    /**
     * @return \Zend\View\Model\ViewModel
     */
    public function indexAction()
    {
        return parent::indexAction(); // TODO: Change the autogenerated stub
    }


}