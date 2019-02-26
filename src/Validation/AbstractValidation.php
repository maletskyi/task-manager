<?php

declare(strict_types=1);

namespace App\Validation;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Validator\Validation;

abstract class AbstractValidation
{
    protected $validator;
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->validator = Validation::createValidator();
    }
}