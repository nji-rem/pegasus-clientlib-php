<?php

namespace Merijn\Pegasus\AppFacade;

use League\Container\Container;
use League\Container\ContainerAwareInterface;
use League\Container\ContainerAwareTrait;
use Merijn\Pegasus\AppFacade\Action\ActionBuilder;
use Merijn\Pegasus\Http\ClientOptions;
use Merijn\Pegasus\Provider\ClientServiceProvider;

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
    }

    public function act(callable $action): void
    {
        $action($builder = new ActionBuilder());

        [$who, $hotel, $action] = $builder->build();

        dd($who, $hotel, $action);
    }
}