<?php

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols;

class HttpRequest
{
    public function __construct(public mixed $body)
    {
    }
}
