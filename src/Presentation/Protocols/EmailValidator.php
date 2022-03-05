<?php

declare(strict_types=1);

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols;

interface EmailValidator
{
    public function isValid(string $email): bool;
}
