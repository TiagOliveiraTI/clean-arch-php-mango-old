<?php

declare(strict_types=1);

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers;

use Tiagoliveirati\CleanArchPhpMango\Presentation\Errors\MissingParamError;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\HttpRequest;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\HttpResponse;

class SignUpController
{
    public function handle(HttpRequest $httpRequest): HttpResponse
    {
        if (!property_exists($httpRequest->body, 'name')) {
            $httpResponse = new HttpResponse();
            $httpResponse->statusCode = 400;
            $httpResponse->body = new MissingParamError('name');

            return $httpResponse;
        }

        if (!property_exists($httpRequest->body, 'email')) {
            $httpResponse = new HttpResponse();
            $httpResponse->statusCode = 400;
            $httpResponse->body = new MissingParamError('email');

            return $httpResponse;
        }
    }
}
