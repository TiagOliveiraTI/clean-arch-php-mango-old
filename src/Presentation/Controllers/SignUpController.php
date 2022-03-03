<?php

declare(strict_types=1);

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers;

use Error;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\HttpRequest;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\HttpResponse;

class SignUpController
{
    public function handle(HttpRequest $httpRequest): HttpResponse
    {
        if (!property_exists($httpRequest->body, 'name')) {
            $httpResponse = new HttpResponse();
            $httpResponse->statusCode = 400;
            $httpResponse->body = new Error('Missing param: name');

            return $httpResponse;
        }

        if (!property_exists($httpRequest->body, 'email')) {
            $httpResponse = new HttpResponse();
            $httpResponse->statusCode = 400;
            $httpResponse->body = new Error('Missing param: email');

            return $httpResponse;
        }
    }
}
