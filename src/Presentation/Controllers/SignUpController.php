<?php

declare(strict_types=1);

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers;

use Tiagoliveirati\CleanArchPhpMango\Presentation\Errors\MissingParamError;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Helpers\HttpHelper;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\Controller;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\HttpRequest;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\HttpResponse;

class SignUpController implements Controller
{
    use HttpHelper;

    public function handle(HttpRequest $httpRequest): HttpResponse
    {
        $requestFields = ["name", "email", "password", "passwordConfirmation"];

        foreach ($requestFields as $field) {
            if (!property_exists($httpRequest->body, $field)) {
                return $this->badRequest(new MissingParamError($field));
            }
        }
    }
}
