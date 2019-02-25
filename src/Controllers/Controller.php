<?php

declare(strict_types=1);

namespace App\Controllers;

use Symfony\Component\HttpFoundation\Response;

class Controller
{
    private const VIEWS_PATH = __DIR__ . '/../../views/';

    public function view($name, $variables = [], $status = 200)
    {
        extract($variables, EXTR_OVERWRITE);

        ob_start();

        require self::VIEWS_PATH . $name . '.php';

        $content = ob_get_contents();

        ob_clean();

        return new Response($content, $status);
    }
}