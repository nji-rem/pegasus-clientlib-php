<?php

namespace Merijn\Pegasus\Contracts\Repository;

interface ApiKeyRepositoryInterface
{
    /**
     * Store the API key.
     *
     * @param string $apiKey
     * @return mixed
     */
    public function storeApiKey(string $apiKey);

    /**
     * Retrieve the API key from the repository.
     *
     * @return string
     */
    public function retrieveApiKey(): string;
}