<?php

declare(strict_types=1);

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Errors;

use Error;

class InvalidParamError extends Error
{
    public function __construct(string $paramName)
    {
        parent::__construct("Invalid param: $paramName");
        $this->name = 'InvalidParamError';
    }
}
