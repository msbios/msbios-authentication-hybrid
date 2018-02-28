<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Authentication\Hybrid\Controller;

use MSBios\Hybridauth\HybridauthAwareInterface;
use MSBios\Hybridauth\HybridauthAwareTrait;
use MSBios\Hybridauth\HybridauthInterface;
use Zend\Http\PhpEnvironment\Response;
use Zend\Mvc\Controller\AbstractActionController;
use Zend\Router\Http\RouteMatch;

/**
 * Class ProviderController
 * @package MSBios\Authentication\Hybrid\Controller
 */
class ProviderController extends AbstractActionController implements
    HybridauthAwareInterface
{
    use HybridauthAwareTrait;

    public function indexAction()
    {
        /** @var string $identifier */
        $identifier = $this->params()->fromRoute('identifier');

        /** @var \Hybrid_Auth|HybridauthInterface $hybridauth */
        $hybridauth = $this->getHybridauth();

        /** @var \Hybrid_Provider_Adapter $adapter */
        $adapter = $hybridauth->authenticate($identifier, [
            'hauth_return_to' => '/hybridauth/authenticate',
        ]);

        // /** @var RouteMatch $routeMatch */
        // $routeMatch = $this->getEvent()->getRouteMatch();
        // // $redirect = $this->getRedirect($routeMatch->getMatchedRouteName(), $this->getRedirectRouteFromRequest());
        //
        // $redirect = 'http://0.0.0.0:3107/hybridauth/authenticate';
        //
        // /** @var Response $response */
        // $response = $this->getResponse();
        // $response->getHeaders()->addHeaderLine('Location', $redirect);
        // $response->setStatusCode(Response::STATUS_CODE_302);
        //
        // return $response;

    }

    /**
     * Return the redirect from param.
     * First checks GET then POST
     * @return string
     */
    private function getRedirectRouteFromRequest()
    {
        $request = $this->getRequest();
        $redirect = $request->getQuery('redirect');
        if ($redirect && $this->routeExists($redirect)) {
            return $redirect;
        }

        $redirect = $request->getPost('redirect');
        if ($redirect && $this->routeExists($redirect)) {
            return $redirect;
        }

        return false;
    }

    /**
     * @param $route
     * @return bool
     */
    private function routeExists($route)
    {
//        try {
//            $this->route->assemble(array(), array('name' => $route));
//        } catch (RuntimeException $e) {
//            return false;
//        }

        return true;
    }

    /**
     * @return mixed
     */
    public function authenticateAction()
    {
        echo __METHOD__;
        die();
        // For provider authentication, change the auth adapter in the ZfcUser Controller Plugin
        $this->zfcUserAuthentication()->setAuthAdapter($this->getScnAuthAdapterChain());

        // Adding the provider to request metadata to be used by HybridAuth adapter
        $this->getRequest()->setMetadata('provider', $provider);

        // Forward to the ZfcUser Authenticate action
        return $this->forward()->dispatch('zfcuser', array('action' => 'authenticate'));
    }
}