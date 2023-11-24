<?php

namespace App\Services\External;

use Illuminate\Http\Client\Response;

interface RequestInterface
{
    public function url(string $path): string;
    public function send(string $path): Response;
}
