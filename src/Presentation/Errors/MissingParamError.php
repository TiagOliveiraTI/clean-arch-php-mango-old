<?php

declare(strict_types=1);

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Errors;

use Error;

class MissingParamError extends Error
{
    public function __construct(string $paramName)
    {
        parent::__construct("Missing param: $paramName");
        $this->name = 'MissingParamError';
    }
}
