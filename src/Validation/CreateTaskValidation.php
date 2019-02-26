<?php

declare(strict_types=1);

namespace App\Validation;

use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class CreateTaskValidation extends AbstractValidation implements ValidationInterface
{
    public function validate()
    {
        $username = $this->request->get('username');
        $email = $this->request->get('email');
        $content = $this->request->get('content');

        dump($username, $email, $content);

        $violationsUsername = $this->validator->validate($username, [
            new Length(['min' => 2, 'max' => 50]),
            new NotBlank(),
        ], 'username');

        $violationsEmail = $this->validator->validate($email, [
            new Length(['min' => 2, 'max' => 50]),
            new Email(),
        ], 'email');

        $violationsContent = $this->validator->validate($content, [
            new Length(['min' => 10, 'max' => 1000]),
            new NotBlank(),
        ], 'content');

        dump($violationsUsername, $violationsEmail, $violationsContent);
    }
}