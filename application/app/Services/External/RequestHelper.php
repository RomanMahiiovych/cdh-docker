<?php

namespace App\Services\External;

use Illuminate\Http\Client\Response;
use Illuminate\Support\Facades\Http;

class RequestHelper implements RequestInterface
{
    public function __construct(
        private readonly string $xClientToken,
        private readonly string $uri,
    ) {}

    public function url(string $path): string
    {
        return "$this->uri/$path";
    }

    public function send(string $path): Response
    {
        return Http::withHeader('X-Client', $this->xClientToken)
            ->get($this->url($path))
            ->throw();
    }
}
