<?php

declare(strict_types=1);

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers;

class SignUpController
{
    public function handle(mixed $httpRequest): mixed
    {
        return (object) [
            'statusCode' => 400
        ];
    }
}
