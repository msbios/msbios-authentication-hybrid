<?php
/**
 * @access protected
 * @author Judzhin Miles <info[woof-woof]msbios.com>
 */

namespace MSBios\Authentication\Hybrid\Controller;

use MSBios\Authentication\AuthenticationServiceAwareTrait;
use MSBios\Authentication\Hybrid\IdentityResolverAwareTrait;
use MSBios\Authentication\Hybrid\IdentityResolverInterface;
use MSBios\Authentication\Hybrid\ProviderManagerAwareTrait;
use MSBios\Authentication\Hybrid\ProviderManagerInterface;
use MSBios\Authentication\IdentityInterface;
use MSBios\Hybridauth\Controller\IndexController;
use MSBios\Hybridauth\HybridauthManagerAwareTrait;
use MSBios\Hybridauth\HybridauthManagerInterface;
use Zend\Authentication\AuthenticationServiceInterface;
use Zend\Http\PhpEnvironment\Response;
use Zend\View\Model\ViewModel;

/**
 * Class HybridController
 * @package MSBios\Authentication\Hybrid\Controller
 */
class HybridController extends IndexController
{
    /**
     * @link https://docs.zendframework.com/zend-servicemanager/configuring-the-service-manager/#best-practices_2
     */
    use AuthenticationServiceAwareTrait;
    use HybridauthManagerAwareTrait;
    use ProviderManagerAwareTrait;
    use IdentityResolverAwareTrait;

    /**
     * HybridController constructor.
     * @param AuthenticationServiceInterface $authenticationService
     * @param HybridauthManagerInterface $hybridauthManager
     * @param ProviderManagerInterface $providerManager
     * @param IdentityResolverInterface $identityResolver
     */
    public function __construct(
        AuthenticationServiceInterface $authenticationService,
        HybridauthManagerInterface $hybridauthManager,
        ProviderManagerInterface $providerManager,
        IdentityResolverInterface $identityResolver
    )
    {
        $this->setAuthenticationService($authenticationService);
        $this->setHybridauthManager($hybridauthManager);
        $this->setProviderManager($providerManager);
        $this->setIdentityResolver($identityResolver);
    }

    /**
     * @return Response
     */
    public function providerAction()
    {
        /** @var string $identifier */
        $identifier = $this->params()->fromRoute('identifier');

        $this->getHybridauthManager()->authenticate($identifier, [
            'hauth_return_to' => $this->url()->fromRoute('hybridauth/provider/authenticate', [
                'identifier' => $identifier
            ]),
        ]);

        /** @var Response $response */
        $response = $this->getResponse();
        $response->getHeaders()->addHeaderLine('Location', $this->url()->fromRoute('home'));
        $response->setStatusCode(Response::STATUS_CODE_302);
        return $response;
    }

    /**
     * @return ViewModel
     */
    public function authenticateAction()
    {
        return new ViewModel;
    }

    /**
     * @return \Zend\Http\Response
     */
    public function addAction()
    {
        /** @var AuthenticationServiceInterface $authenticationService */
        $authenticationService = $this->getAuthenticationService();

        if (!$authenticationService->hasIdentity()) {
            return $this->redirect()->toRoute('home');
        }

        /** @var string $identifier */
        $identifier = $this->params()->fromRoute('identifier');

        /** @var \Hybrid_User_Profile $userProfile */
        $userProfile = $this->getHybridauthManager()
            ->authenticate($identifier)
            ->getUserProfile();

        $this->writeProvider(
            $authenticationService->getIdentity(),
            $userProfile,
            $identifier
        );

        return $this->redirect()->toRoute('home');
    }

    /**
     * @param IdentityInterface $identity
     * @param \Hybrid_User_Profile $userProfile
     * @param $identifier
     * @return mixed
     */
    protected function writeProvider(IdentityInterface $identity, \Hybrid_User_Profile $userProfile, $identifier)
    {
        return $this->getProviderManager()->write(
            $identity,
            $userProfile,
            $identifier
        );
    }
}
