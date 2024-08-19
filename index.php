<?php

use Merijn\Pegasus\AppFacade\Action\ActionBuilder;
use Merijn\Pegasus\AppFacade\Action\ActionEnum;
use Merijn\Pegasus\AppFacade\Pegasus;
use Merijn\Pegasus\Http\ClientOptions;

require_once __DIR__ . '/vendor/autoload.php';

$pegasus = new Pegasus(
    new ClientOptions("127.0.0.1:666", "5a50aaeb-698b-4c15-8561-337e92265232")
);

$pegasus->act(function (ActionBuilder $builder): void {
    $builder->do(ActionEnum::EnterRoom)
        ->who(collect())
        ->where("Plex Hotel");
});