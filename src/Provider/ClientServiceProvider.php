<?php

namespace Merijn\Pegasus\Provider;

use GuzzleHttp\Client;
use GuzzleHttp\ClientInterface;
use League\Container\ServiceProvider\AbstractServiceProvider;
use Merijn\Pegasus\Http\ClientFactory;
use Merijn\Pegasus\Http\ClientOptions;

class ClientServiceProvider extends AbstractServiceProvider
{
    protected $provides = [
        ClientInterface::class,
        Client::class,
    ];

    public function register(): void
    {
        $fn = function (): ClientInterface {
            $factory = new ClientFactory();

            return $factory->createClient($this->getContainer()->get(ClientOptions::class));
        };

        $this->getContainer()->add(ClientInterface::class, $fn);
        $this->getContainer()->add(Client::class, $fn);
    }
}