<?php

namespace Merijn\Pegasus\AppFacade;

use GuzzleHttp\Client;
use League\Container\Container;
use League\Container\ContainerAwareInterface;
use League\Container\ContainerAwareTrait;
use Merijn\Pegasus\AppFacade\Action\ActionBuilder;
use Merijn\Pegasus\Http\ClientOptions;
use Merijn\Pegasus\Provider\ClientServiceProvider;
use OpenAPI\Client\Api\BotApi;

/**
 * Class Pegasus is a facade, or wrapper, class. It enables a smooth interaction with all dependencies, without all
 * the DI fuzz.
 *
 * It enables developers to just access the Pegasus class - and nothing more. Avoid this facade if you're an experienced
 * developer that needs customizability.
 */
final class Pegasus implements ContainerAwareInterface
{
    use ContainerAwareTrait;

    public function __construct(ClientOptions $clientOptions, Container $container = new Container())
    {
        $this->setContainer($container);

        $this->getContainer()->add(ClientOptions::class, fn () => $clientOptions);
        $this->getContainer()->addServiceProvider(ClientServiceProvider::class);

        $this->registerOpenApiObjects();
    }

    private function registerOpenApiObjects(): void
    {
        $apiDir = str_replace("/src/AppFacade", "", __DIR__) . "/lib/Api";
        if (!is_dir($apiDir)) {
            throw OpenDirectoryFailed::directoryNotFound($apiDir);
        }

        foreach (glob($apiDir . '/*.php') as $file) {
            $relativePath = str_replace([$apiDir, '/', '.php'], ['', '\\', ''], $file);
            $fullClassName = "OpenAPI\\Client\\Api" . $relativePath;

            $this->getContainer()->add($fullClassName, fn () => new $fullClassName($this->getContainer()->get(Client::class)));
        }
    }

    public function botApi(): BotApi
    {
        return $this->getContainer()->get(BotApi::class);
    }

    public function act(callable $action): void
    {
        $action($builder = new ActionBuilder());

        [$who, $hotel, $action] = $builder->build();
    }
}