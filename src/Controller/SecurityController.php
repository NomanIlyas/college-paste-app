<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Exception\AuthenticationException;
use Symfony\Component\Security\Core\Security;

class SecurityController extends AbstractController
{
    /**
     * Renders the login template with the given parameters. Overwrite this function in
     * an extended controller to provide additional data for the login template.
     *
     * @param array $data
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderLogin(array $data)
    {
        $authChecker = $this->get('security.authorization_checker');
        if ($authChecker->isGranted('ROLE_ADMIN') || $authChecker->isGranted('ROLE_SUPER_ADMIN')) {
            $this->addFlash('success', "You are already logged in");
            $entity = 'User';
            return new RedirectResponse(
                $this->get('router')->generate(
                    'easyadmin',
                    ['action' => 'list', 'entity' => $entity, 'ses' => 'clr']
                )
            );
        }
        $template = sprintf('FOSUserBundle:Security:login.html.twig');
        return $this->get('templating')->renderResponse($template, $data);
    }


    /**
     * @param $request
     * @return Response
     */
    public function loginAction(Request $request)
    {
        /**
         * @var $session \Symfony\Component\HttpFoundation\Session\Session
         */
        $session = $request->getSession();
        $lastUsernameKey = Security::LAST_USERNAME;

        $error = $this->checkError($request, $session);
        if (!empty($error)) {
            return $this->redirectAfterLogin();
        }

        // last username entered by the user
        $lastUsername = (null === $session) ? '' : $session->get($lastUsernameKey);
        $csrfToken = $this->has('security.csrf.token_manager')
            ? $this->get('security.csrf.token_manager')->getToken('authenticate')->getValue()
            : null;
        return $this->renderLogin(array(
            'last_username' => $lastUsername,
            'error' => $error,
            'csrf_token' => $csrfToken,
        ));
    }

    /**
     * @return null|RedirectResponse
     */
    private function redirectAfterLogin()
    {
        return $this->redirectToRoute('easyadmin', [
            'action' => 'list',
            'entity' => 'User',
            'ses' => 'clr'
        ]);
    }

    /**
     * @param Request $request
     * @param Session $session
     * @return mixed|null
     */
    private function checkError(Request $request, Session $session)
    {
        $authErrorKey = Security::AUTHENTICATION_ERROR;
        // get the error if any (works with forward and redirect -- see below)
        if ($request->attributes->has($authErrorKey)) {
            $error = $request->attributes->get($authErrorKey);
        } elseif (null !== $session && $session->has($authErrorKey)) {
            $error = $session->get($authErrorKey);
            $session->remove($authErrorKey);
        } else {
            $error = null;
        }
        if (!$error instanceof AuthenticationException) {
            $error = null; // The value does not come from the security component.
        }
        return $error;
    }

}
