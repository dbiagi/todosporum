<?php

namespace App\Security;

use Symfony\Bundle\FrameworkBundle\Routing\Router;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Exception\CustomUserMessageAuthenticationException;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Security\Core\User\UserProviderInterface;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Security\Guard\AbstractGuardAuthenticator;

/**
 * Definition of CustomAuthenticator
 *
 * @author Diego de Biagi <diegobiagiviana@gmail.com>
 */
class CustomAuthenticator extends AbstractGuardAuthenticator
{
    const CRSF_TOKEN_ID = 'authenticate';

    /** @var Router */
    private $router;

    /** @var UserPasswordEncoderInterface */
    private $encoder;

    /** @var CsrfTokenManagerInterface */
    private $csrfTokenManager;

    function __construct(
        Router $router,
        UserPasswordEncoderInterface $encoder,
        CsrfTokenManagerInterface $csrfTokenManager
    )
    {
        $this->router           = $router;
        $this->encoder          = $encoder;
        $this->csrfTokenManager = $csrfTokenManager;
    }

    /**
     * {@inheritdoc}
     */
    public function start(Request $request, AuthenticationException $authException = null)
    {
        return new RedirectResponse($this->router->generate('fos_user_security_login'));
    }

    /**
     * {@inheritdoc}
     */
    public function getCredentials(Request $request)
    {
        if (!$request->isMethod('POST') || !$request->get('_username')) {
            return null;
        }

        if (!$this->isCsrfTokenValid(self::CRSF_TOKEN_ID, $request->get('_token'))) {
            throw new CustomUserMessageAuthenticationException('Invalid token.');
        }

        return [
            'username' => $request->get('_username'),
            'password' => $request->get('_password')
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function getUser($credentials, UserProviderInterface $userProvider)
    {
        if (!$userProvider instanceof EmailUserProvider) {
            return;
        }

        return $userProvider->loadUserByUsername($credentials['username']);
    }

    /**
     * {@inheritdoc}
     */
    public function checkCredentials($credentials, UserInterface $user)
    {
        $valid = $this->encoder->isPasswordValid($user, $credentials['password']);

        if (!$valid) {
            throw new CustomUserMessageAuthenticationException('invalid.password');
        }

        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationFailure(Request $request, AuthenticationException $exception)
    {
        $request->getSession()->getFlashBag()->add('error', $exception->getMessage());
        $request->getSession()->set(Security::LAST_USERNAME, $request->get('_username'));

        return new RedirectResponse($this->router->generate('fos_user_security_login'));
    }

    /**
     * {@inheritdoc}
     */
    public function onAuthenticationSuccess(Request $request, TokenInterface $token, $providerKey)
    {
        return new RedirectResponse($this->router->generate('main_home'));
    }

    /**
     * {@inheritdoc}
     */
    public function supportsRememberMe()
    {
        return true;
    }

    /**
     * {@inheritdoc}
     */
    public function supports(Request $request)
    {
        return true;
    }

    /**
     * Checks the validity of a CSRF token.
     *
     * @param string $id The id used when generating the token
     * @param string $token The actual token sent with the request that should be validated
     *
     * @return bool
     */
    protected function isCsrfTokenValid($id, $token)
    {
        return $this->csrfTokenManager->isTokenValid(new CsrfToken($id, $token));
    }
}