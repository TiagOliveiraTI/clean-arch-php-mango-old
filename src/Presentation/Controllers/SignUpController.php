<?php

declare(strict_types=1);

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers;

use Error;

class SignUpController
{
    public function handle(mixed $httpRequest): mixed
    {
        if (!property_exists($httpRequest->body, 'name')) {
            return (object) [
                'statusCode' => 400,
                'body' => new Error('Missing param: name')
            ];
        }

        if (!property_exists($httpRequest->body, 'email')) {
            return (object) [
                'statusCode' => 400,
                'body' => new Error('Missing param: email')
            ];
        }
    }
}
