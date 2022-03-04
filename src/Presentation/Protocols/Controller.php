<?php

namespace Tiagoliveirati\CleanArchPhpMango\Presentation\Protocols;

interface Controller
{
    public function handle(HttpRequest $httpRequest): HttpResponse;
}
