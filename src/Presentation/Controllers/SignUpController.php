<?php

declare(strict_types=1);

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Controllers;

use Tiagoliveirati\CleanArchPhpMango\Presentation\Helpers\HttpHelper;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\Controller;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\HttpRequest;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\HttpResponse;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Errors\InvalidParamError;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Errors\MissingParamError;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\EmailValidator;

class SignUpController implements Controller
{
    use HttpHelper;

    public function __construct(private EmailValidator $emailValidator)
    {
    }

    public function handle(HttpRequest $httpRequest): HttpResponse
    {
        try {
            $requestFields = ["name", "email", "password", "passwordConfirmation"];

            foreach ($requestFields as $field) {
                if (!property_exists($httpRequest->body, $field)) {
                    return $this->badRequest(new MissingParamError($field));
                }
            }

            if ($httpRequest->body->password !== $httpRequest->body->passwordConfirmation) {
                return $this->badRequest(new InvalidParamError('passwordConfirmation'));
            }

            $isValid = $this->emailValidator->isValid($httpRequest->body->email);

            if (!$isValid) {
                return $this->badRequest(new InvalidParamError('email'));
            }
        } catch (\Throwable $th) {
            return $this->serverError();
        }
    }
}
