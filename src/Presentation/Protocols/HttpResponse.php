<?php

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols;

class HttpResponse
{
    public function __construct()
    {
        $this->response = [
        'statusCode' => null,
        'body' => null
        ];
    }
}
