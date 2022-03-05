<?php

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Helpers;

use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\EmailValidator;

class EmailValidatorStub implements EmailValidator
{
    public function isValid(string $email): bool
    {
        return true;
    }
}
