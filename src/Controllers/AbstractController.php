<?php

declare(strict_types=1);

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\Session;

abstract class AbstractController
{
    protected const VIEWS_PATH = __DIR__ . '/../../views/';

    protected $session;

    public function __construct(Session $session)
    {
        $this->session = $session;
    }

    public function view($name, $variables = [], $status = 200): Response
    {
        $variables['session'] = $this->session;

        extract($variables, EXTR_OVERWRITE);

        ob_start();

        require self::VIEWS_PATH . $name . '.php';

        $content = ob_get_contents();

        ob_clean();

        return new Response($content, $status);
    }
}