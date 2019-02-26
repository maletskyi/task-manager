<?php

declare(strict_types=1);

namespace App\Validation;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\ConstraintViolation;

class TaskValidation extends AbstractValidation implements ValidationInterface
{
    public function validate()
    {
        $username = $this->request->get('username');
        $email = $this->request->get('email');
        $content = $this->request->get('content');

        $violationsUsername = $this->validator->validate($username, [
            new Length(['min' => 2, 'max' => 50]),
            new NotBlank(),
        ]);

        $violationsEmail = $this->validator->validate($email, [
            new Length(['min' => 2, 'max' => 50]),
            new NotBlank(),
            new Email(),
        ]);

        $violationsContent = $this->validator->validate($content, [
            new Length(['min' => 10, 'max' => 1000]),
            new NotBlank(),
        ]);

        $errors = [];

        if (count($violationsUsername) !== 0) {
            $errors['username'] = $violationsUsername->get(0)->getMessage();
        }

        if (count($violationsEmail) !== 0) {
            $errors['email'] = $violationsEmail->get(0)->getMessage();
        }

        if (count($violationsContent) !== 0) {
            $errors['content'] = $violationsContent->get(0)->getMessage();
        }

        return $errors;
    }
}