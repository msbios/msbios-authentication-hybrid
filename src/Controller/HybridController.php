<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Authentication\Hybrid\Controller;

use MSBios\Authentication\AuthenticationServiceAwareInterface;
use MSBios\Authentication\AuthenticationServiceAwareTrait;
use MSBios\Hybridauth\Controller\IndexController;
use MSBios\Hybridauth\HybridauthManagerInterface;
use Zend\Http\PhpEnvironment\Response;
use Zend\Router\Http\RouteMatch;

/**
 * Class HybridController
 * @package MSBios\Authentication\Hybrid\Controller
 */
class HybridController extends IndexController implements
    AuthenticationServiceAwareInterface
{
    use AuthenticationServiceAwareTrait;

    /**
     * @return Response
     */
    public function providerAction()
    {
        /** @var string $identifier */
        $identifier = $this->params()->fromRoute('identifier');

        /** @var \Hybrid_Auth|HybridauthManagerInterface $hybridauthManager */
        $hybridauthManager = $this->getHybridauthManager();

        /** @var \Hybrid_Provider_Adapter $adapter */
        $adapter = $hybridauthManager->authenticate($identifier, [
            'hauth_return_to' => $this->url()->fromRoute('hybridauth/provider/authenticate', [
                'identifier' => $identifier
            ]),
        ]);

        // r($adapter->getAccessToken()); die();
        // r($adapter->getUserProfile()); die();

        /** @var RouteMatch $routeMatch */
        $routeMatch = $this->getEvent()->getRouteMatch();

        // /** @var RouteMatch $routeMatch */
        // $routeMatch = $this->getEvent()->getRouteMatch();
        // // $redirect = $this->getRedirect($routeMatch->getMatchedRouteName(), $this->getRedirectRouteFromRequest());
        //
        // $redirect = 'http://0.0.0.0:3107/hybridauth/authenticate';

        /** @var Response $response */
        // $response = $this->getResponse();
        // $response->getHeaders()->addHeaderLine('Location', $redirect);
        // $response->setStatusCode(Response::STATUS_CODE_302);
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

////        r(\Hybrid_Auth::getSessionData()); die();
////         r($this->getAuthenticationService()); die();
//
//        //echo __METHOD__;
//        //die();
//        // For provider authentication, change the auth adapter in the ZfcUser Controller Plugin
//        $this->zfcUserAuthentication()->setAuthAdapter($this->getScnAuthAdapterChain());
//
//        // Adding the provider to request metadata to be used by HybridAuth adapter
//        $this->getRequest()->setMetadata('provider', $provider);
//
//        // Forward to the ZfcUser Authenticate action
//        return $this->forward()->dispatch('zfcuser', ['action' => 'authenticate']);
    }

    /**
     * @return \Zend\Http\Response
     */
    public function logoutAction()
    {
        $this->getAuthenticationService()->clearIdentity();
        // return $this->forward()->dispatch('zfcuser', array('action' => 'logout'));
        \Hybrid_Auth::logoutAllProviders();
        return $this->redirect()->toRoute('home');
    }
}
