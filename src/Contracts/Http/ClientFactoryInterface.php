<?php

namespace Merijn\Pegasus\Contracts\Http;

use GuzzleHttp\Client;
use Merijn\Pegasus\Http\ClientOptions;

interface ClientFactoryInterface
{
    /**
     * @param ClientOptions $options
     * @return Client
     */
    public function createClient(ClientOptions $options): Client;
}