<?php

declare(strict_types=1);

namespace App\Controllers;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

class AdminController extends Controller
{
    private $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function login(Request $request): Response
    {
        $login = $request->get('login');
        $password = $request->get('password');

        if ($login === 'admin' && $password === '123') {
            $this->session->set('login', 'admin');
            $this->session->set('password', sha1('123'));

            $this->session->getFlashBag()->add('message', 'You successfully logged in');

            return new RedirectResponse('/');
        }

        $this->session->getFlashBag()->add('error', 'Login or password are wrong');

        return new RedirectResponse('/');
    }

    public function logout(): Response
    {
        $this->session->remove('login');
        $this->session->remove('password');

        $this->session->getFlashBag()->add('message', 'You successfully logged out');

        return new RedirectResponse('/');
    }
}