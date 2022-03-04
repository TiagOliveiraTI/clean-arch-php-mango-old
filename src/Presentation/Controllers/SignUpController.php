<?php

declare(strict_types=1);

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers;

use Tiagoliveirati\CleanArchPhpMango\Presentation\Errors\MissingParamError;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Helpers\HttpHelper;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\HttpRequest;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\HttpResponse;

class SignUpController
{
    use HttpHelper;

    public function handle(HttpRequest $httpRequest): HttpResponse
    {
        if (!property_exists($httpRequest->body, 'name')) {
            return $this->badRequest(new MissingParamError("name"));
        }

        if (!property_exists($httpRequest->body, 'email')) {
            return $this->badRequest(new MissingParamError("email"));
        }
    }
}
