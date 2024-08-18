<?php

namespace Merijn\Pegasus\Http;

use GuzzleHttp\Client;
use GuzzleHttp\HandlerStack;
use Merijn\Pegasus\Contracts\Http\ClientFactoryInterface;

readonly class ClientFactory implements ClientFactoryInterface
{
    public function createClient(ClientOptions $options): Client
    {
        $opts = [
            'base_url' => $options->address,
            'handler' => HandlerStack::create(),
        ];

        $opts['handler']->push(ApiKeyMiddleware::make($options->apiKey));

        return new Client($opts);
    }
}