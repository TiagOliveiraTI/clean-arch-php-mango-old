<?php

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Helpers;

use Error;
use Exception;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\EmailValidator;

class EmailValidatorThrowStub implements EmailValidator
{
    public function isValid(string $email): bool
    {
        throw new Exception("Error Processing Request", 1);
    }
}
