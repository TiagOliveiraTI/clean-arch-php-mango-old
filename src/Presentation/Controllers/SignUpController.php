<?php

declare(strict_types=1);

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers;

use Error;

class SignUpController
{
    public function handle(mixed $httpRequest): mixed
    {
        return (object) [
            'statusCode' => 400,
            'body' => new Error('Missing param: name')
        ];
    }
}
