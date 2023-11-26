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

    public function query(array $extra = []): array
    {
        return [...$extra];
    }

    public function send(string $path, array $extra): Response
    {
        return Http::withHeader('X-Client', $this->xClientToken)
            ->get($this->url($path), $this->query($extra))
            ->throw();
    }
}
