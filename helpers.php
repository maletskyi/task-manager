<?php

declare(strict_types=1);

use Symfony\Component\HttpFoundation\Session\Session;

function isAdmin(Session $session): bool
{
    $login = $session->get('login');
    $password = $session->get('password');

    return $login === 'admin' && $password === sha1('123');
}