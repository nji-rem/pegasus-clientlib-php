<?php

namespace Merijn\Pegasus\Http;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ServerRequestInterface;

class ApiKeyMiddleware
{
    public static function make(string $apiKey): callable
    {
        return function (callable $next) use ($apiKey): callable {
            return function (RequestInterface $request, array $options) use ($next, $apiKey) {
                $request = $request->withHeader('x-auth-token', $apiKey);

                return $next($request, $options);
            };
        };
    }
}