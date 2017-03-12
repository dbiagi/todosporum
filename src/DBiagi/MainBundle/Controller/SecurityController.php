<?php

namespace DBiagi\MainBundle\Controller;

use DBiagi\MainBundle\Security\CustomAuthenticator;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;

class SecurityController extends Controller {

    /**
     *
     * @Route("/login", name="main_login")
     *
     * @return Response
     */
    public function loginAction() {
        $authUtils = $this->get('security.authentication_utils');

        $token = $this
            ->get('security.csrf.token_manager')
            ->getToken(CustomAuthenticator::TOKEN_ID)
            ->getValue();

        return $this->render('Security/login.html.twig', [
            'last_username' => $authUtils->getLastUsername(),
            '_token'        => $token,
        ]);
    }
}
