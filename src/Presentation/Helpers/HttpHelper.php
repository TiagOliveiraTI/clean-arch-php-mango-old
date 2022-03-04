<?php

declare(strict_types=1);

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Helpers;

use Error;
use stdClass;
use Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols\HttpResponse;

trait HttpHelper
{
    public function badRequest(Error $error): HttpResponse
    {
        $httpResponse = new HttpResponse();
        $httpResponse->statusCode = 400;
        $httpResponse->body = $error;

        return $httpResponse;
    }
}
