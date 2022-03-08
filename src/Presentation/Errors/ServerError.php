<?php

declare(strict_types=1);

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Errors;

use Error;

class ServerError extends Error
{
    public function __construct()
    {
        parent::__construct("Internal server error");
        $this->name = 'ServerError';
    }
}
