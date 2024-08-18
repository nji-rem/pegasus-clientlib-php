<?php

namespace Merijn\Pegasus\Http;

final readonly class ClientOptions
{
    public function __construct(
        public string $address,
        public string $apiKey
    ) { }
}